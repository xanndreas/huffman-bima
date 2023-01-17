<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\EmailTrait;
use App\Http\Controllers\Utils\Huffman;
use App\Mail\HuffmanMailable;
use App\Models\Draft;
use App\Models\Sent;
use App\Models\Trash;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    use EmailTrait;

    protected Huffman $huffman;
    protected $dictionary;

    public function __construct()
    {
        $this->huffman = new Huffman();
        $this->huffman->generateDictionary('0123456789abcdefghijklmnopqrstuvwxyzABCDEFHIJKLMNOPQRSTUVWXYZ ~`!@#$%°^&*()-_+={}[]|\/:;"<>,.?');

        $this->dictionary = $this->huffman->getDictionary();
    }

    public function index(Request $request)
    {
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'email-application',
        ];

        return view('content.admin.email.index', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * @throws \Exception
     */
    public function encoders(Request $request)
    {
        $result = [];
        if ($request->status && $request->message) {
            if ($request->status == 'encoded') {
                $decoder = $this->huffman->decode(base64_decode($request->message));
                $result['status'] = 'decoded';
                $result['message'] = $decoder;

            } else if ($request->status == 'decoded') {
                $encoder = base64_encode($this->huffman->encode($request->message));
                $result['status'] = 'encoded';
                $result['message'] = $encoder;
            }
        }

        return json_encode(['data' => $result]);
    }

    public function adapters($folder, Request $request)
    {
        $dateNow = Carbon::now();
        if ($request->last_update !== 'undefined' && $request->last_update !== null) {
            $dateLast = Carbon::createFromFormat('Y-m-d H:i:s', $request->last_update);
        } else {
            $dateLast = $dateNow;
        }

        $results = [];
        $contents = [];

        if ($folder == 'inbox') {
            if ($dateLast->diffInMinutes($dateNow) > 2 || $request->last_content_length !== 0) {
                $contents = $this->mailContentParser();
            }
        } else if ($folder == 'draft') {
            $drafts = Draft::with('user')->where('user_id', Auth::id())->get();
            $contents = $this->draftParser($drafts);
        } else if ($folder == 'sent') {
            $sent = Sent::with('draft')->whereRelation('draft', 'user_id', Auth::id())->get();
            $contents = $this->sentParser($sent);
        } else if ($folder == 'trash') {
            $sent = Trash::with('draft')->whereRelation('draft', 'user_id', Auth::id())->get();
            $contents = $this->sentParser($sent);
        }

        $results['contentRaw'] = view('content.admin.email.partials.items', compact('contents', 'folder'))->render();
        $results['contents'] = $contents;
        $results['content_length'] = count($contents);
        $results['last_update'] = $dateNow->format('Y-m-d H:i:s');

        return json_encode(['data' => $results]);
    }

    public function sentParser($objects): array
    {
        $result = [];
        foreach ($objects as $item) {
            $draft = $item->draft->load('user');
            $result[] = [
                'id' => $draft->id ?? '',
                'subject' => $draft->subject ?? '',
                'content' => $draft->message ?? '',
                'date' => $draft->created_at->diffForHumans() ?? '',
                'senderName' => $draft->user->name ?? '',
                'senderAddress' => $draft->user->email ?? '',
                'to' => $item->to
            ];
        }

        return $result;
    }

    public function draftParser($objects): array
    {
        $result = [];
        foreach ($objects as $item) {
            $isSent = Sent::with('draft')->where('draft_id', $item->id)->first();
            $isTrash = Trash::with('draft')->where('draft_id', $item->id)->first();
            if (!$isSent && !$isTrash) {
                $result[] = [
                    'id' => $item->id ?? '',
                    'subject' => $item->subject ?? '',
                    'content' => $item->message ?? '',
                    'date' => $item->created_at->diffForHumans() ?? '',
                    'senderName' => $item->user->name ?? '',
                    'senderAddress' => $item->user->email ?? '',
                    'to' => $item->to
                ];
            }
        }

        return $result;
    }

    public function composeDelete(Request $request)
    {
        if ($request->draft_id != null) {
            $draft = Draft::with('user')->where('id', $request->draft_id)->first();
            if ($draft) {
                $trash = Trash::with('draft')->where('draft_id', $draft->id)->first();
                if (!$trash) {
                    $trash = Trash::create([
                        'trashed_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'draft_id' => $request->draft_id
                    ]);
                }
            }
        }

        return json_encode(['data' => []]);
    }

    public function composeDraft(Request $request)
    {
        $results = [];
        if ($request->subject != null && $request->to != null && $request->message != null) {
            $draft = Draft::create(array_merge($request->all(), ['user_id' => auth()->id()]));
            if ($draft) {
                $results = $draft;
            }
        }

        return json_encode(['data' => $results]);
    }

    public function composeSend(Request $request)
    {
        $results = null;
        if ($request->subject != null && $request->to != null && $request->message != null) {
            if ($request->draft_id != null) {
                $draft = Draft::with('user')->where('id', $request->draft_id)->first();
                $draft?->update($request->except('draft_id'));
            } else {
                $draft = Draft::create(array_merge($request->all(), ['user_id' => Auth::id()]));
            }

            $data = [
                'subject' => $request->subject,
                'email' => Auth::user()->email,
                'name' => Auth::user()->name,
                'contents' => base64_encode($this->huffman->encode(str_replace("'", "", $request->message)))
            ];

            Mail::to($request->to)->send(new HuffmanMailable($data));
            Sent::create([
                'sent_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'draft_id' => $draft->id
            ]);

            $results = [
                'status' => true,
                'message' => 'Operation ok'
            ];
        } else {
            $results = [
                'status' => false,
                'message' => 'Please fill all fields'
            ];
        }

        return json_encode(['data' => $results]);
    }


    public function mailContentParser(): array
    {
        return $this->getMailContents(auth()->user()->email, auth()->user()->email_credentials);
    }
}
