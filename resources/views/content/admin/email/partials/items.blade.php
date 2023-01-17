@if(count($contents) > 0)
    <ul class="email-media-list">
        @foreach($contents as $item)
            <li class="d-flex user-mail {{ $folder }}" data-id="{{ $item['id'] ?? 'user-mail' }}">
                <div class="mail-left pe-2">
                    <div class="avatar">
                        <img src="{{asset('images/avatars/default.png')}}" alt="avatar img holder"/>
                    </div>
                </div>
                <div class="mail-body">
                    <div class="mail-details">
                        <div class="mail-items">
                            <h5 class="mb-25 mail-item-from">{{ $item['senderName'] ?? 'mail-item-from' }}</h5>
                            <span class="text-truncate mail-item-subject">{{ $item['subject'] }}</span>
                        </div>
                        <div class="mail-meta-item">
                            <span class="me-50 bullet bullet-success bullet-sm"></span>
                            <span class="mail-date mail-item-time">{{ $item['date'] ?? 'mail-item-time'}}</span>
                        </div>
                    </div>
                    <div class="mail-message">
                        <p class="text-truncate mb-0 mail-item-preview">
                            {{ $item['content'] ?? 'mail-item-preview' }}
                        </p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <script>
        $(function () {
            function isBase64(str) {
                if (str ==='' || str.trim() ===''){ return false; }
                try {
                    return btoa(atob(str)) === str;
                } catch (err) {
                    return false;
                }
            }

            $('.user-mail').on('click', function () {
                let mailSessions = window.localStorage.getItem('mail-sessions');
                if (mailSessions) {
                    let selectionItems = JSON.parse(mailSessions);
                    let selectedId = $(this).data('id');

                    if (typeof selectionItems['contents'] !== 'undefined') {
                        selectionItems['contents'].map((val) => {
                            if (selectedId === val.id) {

                                if ($(this).hasClass('draft')) {
                                    let quill_editor = $('.compose-form .ql-editor');
                                    quill_editor[0].innerHTML = val.content;

                                    $('.compose-to').val(val.to).trigger('change');
                                    $('.compose-draft-id').val(val.id).trigger('change');
                                    $('.compose-subject').val(val.subject).trigger('change');

                                    $('#compose-mail').modal('show');
                                } else if ($(this).hasClass('inbox') || $(this).hasClass('sent')) {
                                    let contents = val.content;
                                    if (isBase64(contents)) {
                                        contents = atob(contents);
                                    }

                                    $('.mail-detail-subject').html(val.subject);
                                    $('.mail-detail-content').html(contents);
                                    $('.mail-detail-date').html(val.date);
                                    $('.mail-detail-to').html(val.to);
                                    $('.mail-detail-from-address').html(val.senderAddress);
                                    $('.mail-detail-address').html(val.senderAddress);
                                    $('.mail-detail-from').html(val.senderName);
                                    $('.mail-detail-ava').html((val.senderName).substring(0, 2).toUpperCase());
                                    $('.mail-huffman-ids').val(val.id);

                                    $('.email-app-details').addClass('show');
                                }
                            }
                        });

                    }
                }
            });

        });
    </script>

@else
    <div class="no-results">
        <h5>No Items Found</h5>
    </div>
@endif
