@if (session('success'))
    <div id="alert-success" class="mx-auto max-w-md flex items-center p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-green-100 dark:text-green-800 shadow-sm transition-all duration-300 hover:shadow-md" role="alert">
        <svg class="flex-shrink-0 w-6 h-6 me-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <div class="ms-1 text-base font-medium text-center flex-grow">
            {{ session('success') }}
        </div>
        <button type="button" class="ml-auto bg-green-50 text-green-600 rounded-lg p-1.5 hover:bg-green-100 inline-flex items-center justify-center h-8 w-8 dark:bg-green-100 dark:hover:bg-green-200" data-dismiss-target="#alert-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

@if (session('error'))
    <div id="alert-error" class="mx-auto max-w-md flex items-center p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-red-100 dark:text-red-800 shadow-sm transition-all duration-300 hover:shadow-md" role="alert">
        <svg class="flex-shrink-0 w-6 h-6 me-3 text-red-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <div class="ms-1 text-base font-medium text-center flex-grow">
            {{ session('error') }}
        </div>
        <button type="button" class="ml-auto bg-red-50 text-red-600 rounded-lg p-1.5 hover:bg-red-100 inline-flex items-center justify-center h-8 w-8 dark:bg-red-100 dark:hover:bg-red-200" data-dismiss-target="#alert-error" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('[id^="alert-"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('opacity-0');
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });

    // Close button functionality
    const closeButtons = document.querySelectorAll('[data-dismiss-target]');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = document.querySelector(this.getAttribute('data-dismiss-target'));
            target.classList.add('opacity-0');
            setTimeout(() => {
                target.remove();
            }, 300);
        });
    });
});
</script>