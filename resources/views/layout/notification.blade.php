<Script type="text/javascript">
    $(document).ready(function () {
//notify
    //guest
	@if (session('validator') == "failed")
            new PNotify({
                title: '{{trans("notif.access_denied")}}!',
                text: '{{trans("notif.system_failed_validate")}}!',
                icon: 'icofont icofont-info-circle',
                type: 'error'
            });
        @endif
        @if (session('login') == "error")
            new PNotify({
                title: '{{ trans("notif.login_failed") }}',
                text: '{{ trans("notif.recheck_email_password") }}',
                icon: 'icofont icofont-info-circle',
                type: 'error'
            });
        @endif
        @if (session('login') == "denied")
            new PNotify({
                title: '{{ trans("notif.login_failed") }}!',
                text: '{{ trans("notif.login_first") }}',
                icon: 'icofont icofont-info-circle',
                type: 'warning'
            });
        @endif
        @if (session('login') == "logout")
            new PNotify({
                title: '{{ trans("notif.success") }}!',
                text:  '{{ trans("notif.logout_success") }}.',
                icon: 'icofont icofont-businessman',
                type: 'success'
            });
        @endif
        @if (session('event') == "error")
            new PNotify({
                title: '{{ trans("notif.access_denied") }}!',
                text:  '{{ trans("notif.wrong_key_event") }}.',
                icon: 'icofont icofont-businessman',
                type: 'error'
            });
        @endif
        @if (session('event') == "expired")
            new PNotify({
                title: '{{ trans("notif.access_denied") }}!',
                text:  '{{ trans("notif.event_expired") }}.',
                icon: 'icofont icofont-businessman',
                type: 'warning'
            });
        @endif
    });
</Script>
