<div>
    <!-- Well begun is half done. - Aristotle -->
    @if($errors->any())
        <script>
            let message = '{{$errors->first()}}';
            new PNotify({
                title: 'Error',
                text: message,
                type: 'error',
            });
        </script>
    @endif


    @if ($message = Session::get('success'))
        <script>
            let message = '{!! $message !!}';
            new PNotify({
                title: 'Success',
                text: message,
                type: 'success',
                shadow: true
            });
        </script>
    @endif
</div>
