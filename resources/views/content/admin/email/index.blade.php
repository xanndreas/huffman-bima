@extends('layouts/contentLayoutMaster')

@section('title', 'Email Application')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap"
        rel="stylesheet">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-email.css')) }}">
@endsection

<!-- Sidebar Area -->
@section('content-sidebar')
    @include('content/admin/email/sidebar')
@endsection

@section('content')
    <div class="body-content-overlay"></div>
    <!-- Email list Area -->
    <div class="email-app-list">
        <!-- Email search starts -->
        <div class="app-fixed-search d-flex align-items-center">
            <div class="sidebar-toggle d-block d-lg-none ms-1">
                <i data-feather="menu" class="font-medium-5"></i>
            </div>
            <div class="d-flex align-content-center justify-content-between w-100">
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                    <input
                        type="text"
                        class="form-control"
                        id="email-search"
                        placeholder="Search email"
                        aria-label="Search..."
                        aria-describedby="email-search"
                    />
                </div>
            </div>
        </div>
        <!-- Email search ends -->

        <!-- Email actions starts -->
        <div class="app-action">
            <div class="action-left">
                <label class="form-check-label fw-bolder selected-tabs" for="selectedTabs">INBOX</label>
            </div>
            <div class="action-right">
                <ul class="list-inline m-0">
                    <li class="list-inline-item mail-refresh">
                        <span class="action-icon"><i data-feather="refresh-cw" class="font-medium-2"></i></span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Email actions ends -->

        <!-- Email list starts -->
        <div class="email-user-list user-mail-container">

        </div>
        <!-- Email list ends -->
    </div>
    <!--/ Email list Area -->
    <!-- Detailed Email View -->
    <div class="email-app-details">
        <!-- Detailed Email Header starts -->
        <div class="email-detail-header">
            <div class="email-header-left d-flex align-items-center">
                <span class="go-back me-1"><i data-feather="chevron-left" class="font-medium-4"></i></span>
                <h4 class="email-subject mb-0 mail-detail-subject">mail-detail-subject</h4>
            </div>
        </div>
        <!-- Detailed Email Header ends -->

        <!-- Detailed Email Content starts -->
        <div class="email-scroll-area">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header email-detail-head">
                            <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
                                <div class="avatar avatar-lg me-75">
                                    <input type="hidden" class="mail-huffman-status" value="encoded">
                                    <input type="hidden" class="mail-huffman-ids" value="">
                                    <span
                                        class="avatar-content mail-detail-ava">US</span>
                                </div>
                                <div class="mail-items">
                                    <h5 class="mb-0 mail-detail-from">mail-detail-from</h5>
                                    <div class="email-info-dropup dropdown">
                                        <span
                                            role="button"
                                            class="dropdown-toggle font-small-3 text-muted mail-detail-address"
                                            id="card_top01"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                            mail-detail-address
                                        </span>

                                        <div class="dropdown-menu" aria-labelledby="card_top01">
                                            <table class="table table-sm table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td class="text-end">From:</td>
                                                    <td class="mail-detail-from-address">mail-detail-from-address</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-end">To:</td>
                                                    <td class="mail-detail-to">mail-detail-to</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-end">Date:</td>
                                                    <td class="mail-detail-date">mail-detail-date</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mail-meta-item d-flex align-items-center">
                                <small class="mail-date-time text-muted mail-detail-date"> mail-detail-date</small>
                                <div class="ms-50">
                                    <a type="button" class="mail-huffman">
                                        <i data-feather="eye" class="font-medium-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mail-message-wrapper pt-2">
                            <div class="mail-message mail-detail-content text-wrap">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Detailed Email Content ends -->
    </div>
    <!--/ Detailed Email View -->

    <!-- compose email -->
    <div class="modal modal-sticky" id="compose-mail" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content p-0">
                <div class="modal-header">
                    <h5 class="modal-title">Compose Mail</h5>
                    <div class="modal-actions">
                        <a href="#" class="text-body me-75 compose-maximize"><i data-feather="maximize-2"></i></a>
                        <a class="text-body compose-mail-close" href="#" data-bs-dismiss="modal" aria-label="Close"><i
                                data-feather="x"></i></a>
                    </div>
                </div>
                <div class="modal-body flex-grow-1 p-0">
                    <form class="compose-form">
                        <input type="hidden" class="compose-draft-id" id="draftId" name="draft_id">

                        <div class="compose-mail-form-field">
                            <label for="emailTo" class="form-label">To: </label>
                            <input type="text" id="emailTo" class="form-control compose-to" placeholder="To"
                                   name="to"/>
                        </div>
                        <div class="compose-mail-form-field">
                            <label for="emailSubject" class="form-label">Subject: </label>
                            <input type="text" id="emailSubject" class="form-control compose-subject"
                                   placeholder="Subject"
                                   name="subject"/>
                        </div>
                        <div id="message-editor">
                            <div class="editor compose-message" data-placeholder="Type message..."></div>
                            <div class="compose-editor-toolbar">
                                <span class="ql-formats me-0">
                                    <select class="ql-font">
                                      <option selected>Sailec Light</option>
                                      <option value="sofia">Sofia Pro</option>
                                      <option value="slabo">Slabo 27px</option>
                                      <option value="roboto">Roboto Slab</option>
                                      <option value="inconsolata">Inconsolata</option>
                                      <option value="ubuntu">Ubuntu Mono</option>
                                    </select>
                                </span>
                                <span class="ql-formats me-0">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-link"></button>
                                </span>
                            </div>
                        </div>
                        <div class="compose-footer-wrapper">
                            <div class="btn-wrapper d-flex align-items-center">
                                <div class="btn-group dropup me-1">
                                    <button type="button" class="btn btn-primary compose-mail-send">Send</button>
                                    <button
                                        type="button"
                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-reference="parent"
                                    >
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"> Schedule Send</a>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-action d-flex align-items-center">
                                <a href="javascript:void(0);" class="compose-delete">
                                    <i data-feather="trash" class="font-medium-2 cursor-pointer"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ compose email -->
@endsection

@section('vendor-script')
    <!-- vendor js files -->
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-email.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/emails/email-adapter.js')) }}"></script>
@endsection
