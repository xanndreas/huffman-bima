'use strict';

$(function () {
    var Font = Quill.import('formats/font');
    Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
    Quill.register(Font, true);

    let huffmanTabsGroup = $('.huffman-tabs-group'),
        editorEl = $('#message-editor .editor'),
        mailComposeContainer = $('#compose-mail'),
        mailSessions = window.localStorage.getItem('mail-sessions'),
        mailContainer = $('.user-mail-container'),
        mailDetailContainer = $('.email-app-details'),
        mailDraftId = $('#draftId'),
        mailComposeForm = $('.compose-form'),
        mailLastUpdate,
        mailContentCount;

    // Email compose Editor
    if (editorEl.length) {
        var emailEditor = new Quill(editorEl[0], {
            bounds: '#message-editor .editor',
            modules: {
                formula: true,
                syntax: true,
                toolbar: '.compose-editor-toolbar'
            },
            placeholder: 'Message',
            theme: 'snow'
        });
    }

    if (typeof mailContainer !== "undefined") {
        getMailContents('undefined', 0, 'inbox');
    }

    $('.mail-huffman').on('click', function () {
        let status = $('.mail-huffman-status');
        let message = $('.mail-detail-content');

        let contentParsed = null;

        if (status.val() === 'encoded') {
            let mailSessions = window.localStorage.getItem('mail-sessions');
            if (mailSessions) {
                let selectionItems = JSON.parse(mailSessions);
                let selectedId = $('.mail-huffman-ids').val();

                if (typeof selectionItems['contents'] !== 'undefined') {
                    selectionItems['contents'].map((val) => {
                        if (selectedId == val.id) {
                            contentParsed = val.content
                        }
                    });
                }
            }
        } else if (status.val() === 'decoded') {
            contentParsed = message.html();
        }

        if (status.val() === 'encoded' && !isBase64(contentParsed)) {
            toastr['info']('Not encoded by huffman', 'Information', {
                rtl: false
            });
        } else {
            $.post('/admin/encoders', {
                'status': status.val(),
                'message': contentParsed,
                '_token': $('meta[name="csrf-token"]').attr('content')
            }, function (data, stat) {
                if (stat) {
                    let result = JSON.parse(data);
                    let msgVal = result.data.message;

                    if (isBase64(result.data.message)) {
                        msgVal = atob(result.data.message);
                    }

                    status.val(result.data.status);
                    message.html(msgVal)
                }
            });
        }
    })

    $('.compose-delete').on('click', function () {
        if (mailDraftId.val()) {
            $.post('/admin/compose/delete', {
                'draft_id': mailDraftId.val(),
                '_token': $('meta[name="csrf-token"]').attr('content')
            }, function (data, status) {
                if (status) {
                    mailComposeContainer.modal('hide');
                    toastr['info']('Email daraft deleted', 'Information', {
                        rtl: false
                    });

                    let activeTabs = huffmanTabsGroup.data('active');
                    getMailContents(undefined, 0, activeTabs);
                }
            });
        }
    });

    $('.compose-mail-close').on('click', function () {
        if (!mailDraftId.val()) {
            let messages = emailEditor.root.innerHTML;
            let formData = mailComposeForm.serialize() +
                "&_token=" + $('meta[name="csrf-token"]').attr('content') +
                "&message=" + messages;

            $.post('/admin/compose/drafts', formData, function (data, status) {
                if (status) {
                    mailDraftId.val('')
                }
            });
        }
    });

    $('.mail-refresh').on('click', function () {
        let activeTabs = huffmanTabsGroup.data('active');
        getMailContents(undefined, 0, activeTabs);
    });

    $('.compose-mail-send').on('click', function () {
        let messages = emailEditor.root.innerHTML;
        let formData = mailComposeForm.serialize() +
            "&_token=" + $('meta[name="csrf-token"]').attr('content') +
            "&message=" + messages;

        mailComposeContainer.modal('hide');
        toastr['info']('Email schedule to send', 'Information', {
            rtl: false
        });

        $.post('/admin/compose/sends', formData, function (data, status) {
            if (status) {
                let result = JSON.parse(data);
                if (result.data.status === false) {
                    toastr['error'](result.data.message, 'Error', {
                        rtl: false
                    });
                } else {
                    mailDraftId.val('');

                    let dataActive = huffmanTabsGroup.attr("data-active");
                    getMailContents('undefined', 0, dataActive);
                }
            }
        });
    });

    $('.huffman-tabs').on('click', function (e) {
        let activeTabs = huffmanTabsGroup.attr("data-active");
        let currentTabs = $(this).data('action');

        if (activeTabs !== currentTabs) {
            if (mailDetailContainer.hasClass('show')) {
                mailDetailContainer.removeClass('show');
            }

            huffmanTabsGroup.attr("data-active", currentTabs);
            $('.selected-tabs').html(currentTabs.toUpperCase());

            if (mailSessions) {
                let mailSessionObject = JSON.parse(mailSessions);
                mailLastUpdate = mailSessionObject['last_update'];
                mailContentCount = mailSessionObject['content_length'];
            } else {
                mailContentCount = 0;
            }

            getMailContents(mailLastUpdate, mailContentCount, currentTabs);
        }
    });

    function getMailContents(mailLastUpdate, mailContentCount, toSet) {
        blockContainer();
        $.post('/admin/adapters/' + toSet, {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'last_update': mailLastUpdate,
            'last_content_length': mailContentCount
        }, function (data, status) {
            let result = JSON.parse(data);
            if (status) {
                unblockContainer();

                window.localStorage.setItem('mail-sessions', JSON.stringify({
                    'last_update': result.data.last_update,
                    'content_length': result.data.content_length ?? 0,
                    'contents': result.data.contents,
                    'contentRaw': result.data.contentRaw
                }));

                mailContainer.html(result.data.contentRaw);
            }
        });
    }

    function blockContainer() {
        mailContainer.block({
            message: '<div class="spinner-grow spinner-grow-sm text-white" role="status"></div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        });
    }

    function isBase64(str) {
        if (str === '' || str.trim() === '') { return false; }
        try {
            return btoa(atob(str)) === str;
        } catch (err) {
            return false;
        }
    }

    function unblockContainer() {
        mailContainer.unblock();
    }
})
