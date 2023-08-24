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
                background: "linear-gradient(to right, #F12F26, #900C3F)",
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
                background: "linear-gradient(to right, #029C25, #03751D)",
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
                background: "linear-gradient(to right, #0978EE, #083B9C)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
</script>
@endif

<script>

    // listenes for toast message browser dispatch event from livewire
    window.addEventListener('success', event => {

        Toastify({
                text: event.detail.message,
                duration: 3000,
                destination: "",
                newWindow: true,
                close: true,
                gravity: "bottom", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #029C25, #03751D)",
                },
                onClick: function() {} // Callback after click
            }).showToast();
    })
</script>