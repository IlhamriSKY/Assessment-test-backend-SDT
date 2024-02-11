@extends($layout)
@section('panel')
    @push('style-push')
        <link rel="stylesheet" href="{{ asset('assets/theme/admin/css/prism.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/theme/admin/css/code-box-copy.min.css') }}" />
    @endpush

    <div class="page-title-wrapper">
        <div class="page-title-left">
            <h2 class="page-title ">{{ translate('Api Document') }}</h2>
        </div>

        <div class="page-title-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <section>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('Documentation') }}</h4>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-1">{{ translate('Before you get started') }}</h6>
                            <div class="lead mb-5">
                                A brief overview of the API and its purpose <br>
                                <strong>Endpoints:</strong> A list of all the endpoints available in the API, including
                                their URLs and the HTTP methods they support.
                                <br>
                                <strong>Request and Response:</strong> The expected request format and the format of the
                                response, including examples of how to use the API and the data that it returns.
                            </div>

                            <p>GET ALL CONTACTS</p>
                            <pre><code>curl --location 'https://mail-laravel-2.dev/api/get/contacts' \
    --header 'Api-key: 40b595e8-4090-4e56-bbe8-c9175511b4b1'</code></pre>

                            <p>GET SPECIFIC CONTACTS</p>
                            <pre><code>curl --location 'https://mail-laravel-2.dev/api/get/contact/1' \
    --header 'Api-key: 40b595e8-4090-4e56-bbe8-c9175511b4b1'</code></pre>

                            <p>ADD CONTACT</p>
                            <pre><code>curl --location 'https://mail-laravel-2.dev/api/add/contact' \
    --header 'Content-Type: application/json' \
    --header 'Api-key: 40b595e8-4090-4e56-bbe8-c9175511b4b1' \
    --data-raw '{
        "email_group_id": 1,
        "email": "ilhamriski@unika.ac.id",
        "name": "ilham 1",
        "birthdate": "12/02/1996",
        "city": "New York",
        "status": 1
    }'</code></pre>

                            <p>EDIT CONTACT</p>
                            <pre><code>curl --location --request PUT 'https://mail-laravel-2.dev/api/edit/contact/1' \
    --header 'Content-Type: application/json' \
    --header 'Api-key: 40b595e8-4090-4e56-bbe8-c9175511b4b1' \
    --data-raw '{
        "email_group_id": 1,
        "email": "asdasd@gmail.com",
        "name": "zzzzzz api",
        "birthdate": "21/10/1996",
        "city": "Semarang",
        "status": 1
    }'</code></pre>

                            <p>DELETE CONTACT</p>
                            <pre><code>curl --location --request DELETE 'https://mail-laravel-2.dev/api/delete/contact/1' \
    --header 'Api-key: 40b595e8-4090-4e56-bbe8-c9175511b4b1'</code></pre>

                            <p>SEND EMAIL</p>
                            <pre><code>curl --location 'https://mail-laravel-2.dev/api/email/send' \
    --header 'Content-Type: application/json' \
    --header 'Api-key: 40b595e8-4090-4e56-bbe8-c9175511b4b1' \
    --header 'Cookie:
    XSRF-TOKEN=...;
    sdt_mailer_session=...'
    --data-raw '{
        "contact": [
            {
                "subject": "demo list info",
                "email": "ilhamriski@unika.ac.id",
                "message": "In publishing and graphic design, Lorem ipsum text",
                "sender_name": "name",
                "reply_to_email": "demo@gmail.com"
            }
        ]
    }'</code></pre>

                            <p>GET EMAIL STATUS</p>
                            <pre><code>curl --location 'https://mail-laravel-2.dev/api/get/email/Hb01aCQJ-QpWftzuavoSNLe-0cYvNha8' \
    --header 'Api-key: 40b595e8-4090-4e56-bbe8-c9175511b4b1' \
    --header 'Cookie:
    XSRF-TOKEN=...;
    sdt_mailer_session=...'</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script-include')
    <script src="{{ asset('assets/theme/admin/js/prism.js') }}"></script>
    <script src="{{ asset('assets/theme/admin/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/theme/admin/js/code-box-copy.min.js') }}"></script>
@endpush


@push('script-push')
    <script>
        "use strict";
        (function($) {
            $('.code-box-copy').codeBoxCopy({
                tooltipText: 'Copied',
                tooltipShowTime: 1000,
                tooltipFadeInTime: 300,
                tooltipFadeOutTime: 300
            });
        })(jQuery);
    </script>
@endpush
