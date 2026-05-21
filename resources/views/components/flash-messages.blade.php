@if(session('success') || session('error') || session('status') || $errors->any())
<div id="flash-container" class="fixed top-24 right-8 z-[100] flex flex-col gap-4 pointer-events-none">
    @if(session('success'))
    <div class="flash-message bg-secondary-container border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] rounded-2xl p-4 flex items-center gap-4 animate-fade-in-right pointer-events-auto rotate-1 hover:rotate-0 transition-transform">
        <div class="w-12 h-12 bg-surface-bright border-2 border-on-background rounded-full flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_#1b1c1c]">
            <span class="material-symbols-outlined text-on-background">check_circle</span>
        </div>
        <div class="pr-8">
            <h4 class="font-label-bold text-label-bold text-on-secondary-container uppercase">Success!</h4>
            <p class="font-body-md text-sm text-on-background">{{ session('success') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-on-background/50 hover:text-on-background">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    @endif

    @if(session('error') || $errors->any())
    <div class="flash-message bg-error-container border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] rounded-2xl p-4 flex items-center gap-4 animate-fade-in-right pointer-events-auto -rotate-1 hover:rotate-0 transition-transform">
        <div class="w-12 h-12 bg-surface-bright border-2 border-on-background rounded-full flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_#1b1c1c]">
            <span class="material-symbols-outlined text-error">error</span>
        </div>
        <div class="pr-8">
            <h4 class="font-label-bold text-label-bold text-on-error-container uppercase">Oops!</h4>
            <p class="font-body-md text-sm text-on-background">
                @if(session('error'))
                    {{ session('error') }}
                @else
                    Something went wrong. Please check the form.
                @endif
            </p>
        </div>
        <button onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-on-background/50 hover:text-on-background">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    @endif

    @if(session('status'))
    <div class="flash-message bg-tertiary-container border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] rounded-2xl p-4 flex items-center gap-4 animate-fade-in-right pointer-events-auto rotate-1 hover:rotate-0 transition-transform">
        <div class="w-12 h-12 bg-surface-bright border-2 border-on-background rounded-full flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_#1b1c1c]">
            <span class="material-symbols-outlined text-on-tertiary-container">info</span>
        </div>
        <div class="pr-8">
            <h4 class="font-label-bold text-label-bold text-on-tertiary-container uppercase">Notice</h4>
            <p class="font-body-md text-sm text-on-background">{{ session('status') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-on-background/50 hover:text-on-background">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    @endif
</div>

<script>
    document.querySelectorAll('.flash-message').forEach(msg => {
        setTimeout(() => {
            msg.classList.add('animate-fade-out-right');
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    });
</script>
@endif
