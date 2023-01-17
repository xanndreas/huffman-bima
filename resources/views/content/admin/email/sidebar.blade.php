<div class="sidebar-content email-app-sidebar">
    <div class="email-app-menu">
        <div class="form-group-compose text-center compose-btn">
            <button
                type="button"
                class="compose-email btn btn-primary w-100"
                data-bs-backdrop="false"
                data-bs-toggle="modal"
                data-bs-target="#compose-mail"
            >
                Compose
            </button>
        </div>
        <div class="sidebar-menu-list">
            <div class="list-group list-group-messages huffman-tabs-group" data-active="inbox">
                <a href="javascript:void(0);" data-action="inbox" class="list-group-item list-group-item-action huffman-tabs active">
                    <i data-feather="mail" class="font-medium-3 me-50"></i>
                    <span class="align-middle">Inbox</span>
{{--                    <span class="badge badge-light-primary rounded-pill float-end">3</span>--}}
                </a>
                <a href="javascript:void(0);" data-action="sent" class="list-group-item list-group-item-action huffman-tabs">
                    <i data-feather="send" class="font-medium-3 me-50"></i>
                    <span class="align-middle">Sent</span>
                </a>
                <a href="javascript:void(0);" data-action="draft" class="list-group-item list-group-item-action huffman-tabs">
                    <i data-feather="edit-2" class="font-medium-3 me-50"></i>
                    <span class="align-middle">Draft</span>
                </a>
                <a href="javascript:void(0);" data-action="trash" class="list-group-item list-group-item-action huffman-tabs">
                    <i data-feather="trash" class="font-medium-3 me-50"></i>
                    <span class="align-middle">Trash</span>
                </a>
            </div>
            <!-- <hr /> -->
            <h6 class="section-label mt-3 mb-1 px-2">Labels</h6>
            <div class="list-group list-group-labels">
                <a href="#" class="list-group-item list-group-item-action"
                ><span class="bullet bullet-sm bullet-success me-1"></span>Personal</a
                >
                <a href="#" class="list-group-item list-group-item-action"
                ><span class="bullet bullet-sm bullet-warning me-1"></span>Important</a
                >
            </div>
        </div>
    </div>
</div>
