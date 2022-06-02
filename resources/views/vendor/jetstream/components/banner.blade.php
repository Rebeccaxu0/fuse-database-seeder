@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}" :class="{ 'bg-indigo-500': style == 'success', 'bg-red-700': style == 'danger' }" style="display: none;" x-show="show && message" x-init="
                document.addEventListener('banner-message', event => {
                    style = event.detail.style;
                    message = event.detail.message;
                    show = true;
                });
            ">
    <div class="sticky top-0 py-2 px-1 sm:px-4 lg:px-6">
        <div class="flex top-0 items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <p class="ml-3 font-medium text-sm text-white truncate" x-text="message"></p>
            </div>
            <div class="flex-shrink-0 sm:ml-3">
                <button type="button" class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition" :class="{ 'hover:bg-indigo-600 focus:bg-indigo-600': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }" aria-label="Dismiss" x-on:click="show = false">
                    <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>