@session('success')
    <script>
        Swal.fire({
            icon: 'success', // Tipe ikon (success, error, warning, info)
            text: {!! json_encode(session('success')) !!}, // Pesan toast
            toast: true, // Tentukan bahwa ini adalah toast
            position: 'bottom-end', // Posisi toast (top-start, top-end, bottom-start, bottom-end)
            showConfirmButton: false, // Tampilkan tombol OK
            background: "#fff",
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
@endsession

@session('error')
    <script>
        Swal.fire({
            icon: 'error', // Tipe ikon (success, error, warning, info)
            text: {!! json_encode(session('error')) !!}, // Pesan toast
            toast: true, // Tentukan bahwa ini adalah toast
            position: 'bottom-end', // Posisi toast (top-start, top-end, bottom-start, bottom-end)
            showConfirmButton: false, // Tampilkan tombol OK
            background: "#fff",
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
@endsession

@session('warning')
    <script>
        Swal.fire({
            icon: 'warning', // Tipe ikon (success, error, warning, info)
            text: {!! json_encode(session('warning')) !!}, // Pesan toast
            toast: true, // Tentukan bahwa ini adalah toast
            position: 'bottom-end', // Posisi toast (top-start, top-end, bottom-start, bottom-end)
            showConfirmButton: false, // Tampilkan tombol OK
            background: "#fff",
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
@endsession

@session('info')
    <script>
        Swal.fire({
            icon: 'info', // Tipe ikon (success, error, warning, info)
            text: text: {!! json_encode(session('info')) !!}, // Pesan toast
            toast: true, // Tentukan bahwa ini adalah toast
            position: 'bottom-end', // Posisi toast (top-start, top-end, bottom-start, bottom-end)
            showConfirmButton: false, // Tampilkan tombol OK
            background: "#fff",
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
@endsession

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Swal.fire({
                icon: 'error', // Tipe ikon (success, error, warning, info)
                text: {!! json_encode($error) !!}, // Pesan toast
                toast: true, // Tentukan bahwa ini adalah toast
                position: 'bottom-end', // Posisi toast (top-start, top-end, bottom-start, bottom-end)
                showConfirmButton: false, // Tampilkan tombol OK
                background: "#fff",
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
        </script>
    @endforeach
@endif
