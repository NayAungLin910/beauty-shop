@push('layout-style-stack')
    <!-- toastify css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endpush

<!-- Toastify Session Partial -->
@if (session()->has('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            destination: "",
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #F12F26, #F06D67)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif
@if (session()->has('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            destination: "",
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif
@if (session()->has('info'))
    <script>
        Toastify({
            text: "{{ session('info') }}",
            duration: 3000,
            destination: "",
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #0978EE, #6EADEF)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif

@push('layout-script-stack')
    <!-- toastify js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endpush
