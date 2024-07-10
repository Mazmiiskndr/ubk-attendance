@php
$containerFooter = (isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
@endphp

<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
    <div class="{{ $containerFooter }}">
        <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
            <div>
                © <script>
                    document.write(new Date().getFullYear())

                </script>, made with ❤️ by <a href="{{ (!empty(config('variables.creatorUrl')) ? config('variables.creatorUrl') : '') }}" target="_blank" class="footer-link text-primary fw-medium">{{ (!empty(config('variables.creatorName')) ? config('variables.creatorName') : '') }}</a>
            </div>
            <div class="d-none d-lg-inline-block">
                <a href="{{ config('variables.licenseUrl') ? config('variables.licenseUrl') : '#' }}" class="footer-link me-4" target="_blank">License</a>
                <a href="{{ config('variables.moreThemes') ? config('variables.moreThemes') : '#' }}" target="_blank" class="footer-link me-4">More Themes</a>
                <a href="{{ config('variables.documentation') ? config('variables.documentation').'/laravel-introduction.html' : '#' }}" target="_blank" class="footer-link me-4">Documentation</a>
                <a href="{{ config('variables.support') ? config('variables.support') : '#' }}" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
            </div>
        </div>
    </div>
</footer>
<div id="successToast" class="bs-toast toast toast-ex my-2 fade bg-white" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
    <div class="toast-header bg-white">
        <i class="fas me-2 text-success"></i>
        <div class="me-auto fw-semibold text-success">Success</div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div id="toastBody" class="toast-body" style="color: #1d1d1d"></div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function showToast(type, message) {

            // Get the toast element and its components
            const toastEl = document.getElementById('successToast');
            const toastIcon = toastEl.querySelector('.fas');
            const toastHeader = toastEl.querySelector('.me-auto');
            const toastBody = document.getElementById('toastBody');

            // Update the toast icon and header based on the type
            if (type === 'success') {
                toastIcon.className = 'fas fa-check-circle text-success me-2';
                toastHeader.textContent = 'Berhasil';
            } else if (type === 'error') {
                toastIcon.className = 'fas fa-times-circle text-danger me-2';
                toastHeader.textContent = 'Error';
            }

            // Set the toast body to the message
            toastBody.textContent = message;

            // Create a new Bootstrap toast and show it
            const toast = new bootstrap.Toast(toastEl);
            toast.show();

            // Add the fadeInUp animation to the toast
            toastEl.classList.add('animate__animated', 'animate__fadeInUpBig');
        }

        // Listen for 'message' event from the window
        window.addEventListener('message', event => {
            // Check if the event contains detail
            if (event.detail) {
                // Extract the error, success, and type from the event detail
                const {
                    error
                    , success
                    , type
                } = event.detail;

                // If the event contains a success detail
                if (success) {
                    showToast('success', success);
                } else if (error) {
                    // Display an error message using Swal.fire
                    Swal.fire({
                        icon: 'error'
                        , title: 'Oops...'
                        , text: error
                    });
                }
            }
        });

        window.addEventListener('show-toast', event => {

            // Check if the event contains detail
            if (event.detail) {
                // Extract the error, success, and type from the event detail
                const [{
                    message
                    , type
                }] = event.detail;

                // If the event contains a success detail
                if (type == 'success') {
                    showToast('success', message);
                } else if (type == 'error') {
                    // Display an error message using Swal.fire

                    Swal.fire({
                        icon: 'error'
                        , type: 'error'
                        , title: 'Oops...'
                        , text: message
                        , customClass: {
                            confirmButton: 'btn btn-primary'
                            , buttonsStyling: false
                        }
                    });
                }

            }
        });

        // Check if there's a success message in the session
        var success = "{{ session()->has('success') }}";
        if (success) {
            // If there is, create a new event with the success message
            var event = new CustomEvent('message', {
                detail: {
                    success: "{!! session('success') !!}"
                }
            });
            // Dispatch the event
            window.dispatchEvent(event);
        }
    });

</script>
@endpush
