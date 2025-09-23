@props(['banner' => null])

@if($banner)
<div id="marketing-banner" class="relative w-full mb-6 rounded-2xl overflow-hidden shadow-soft-xl bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    
    <div class="relative flex flex-col lg:flex-row items-center p-6 lg:p-8">
        <!-- Banner Image -->
        <div class="w-full lg:w-1/3 mb-4 lg:mb-0 lg:pr-6">
            <img src="{{ $banner['image_url'] }}" 
                 alt="{{ $banner['title'] }}" 
                 class="w-full h-48 lg:h-64 object-cover rounded-xl shadow-lg">
        </div>
        
        <!-- Banner Content -->
        <div class="w-full lg:w-2/3 text-center lg:text-left">
            @if($banner['welcome_message'])
                <div class="mb-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 text-white">
                        <i class="fas fa-star mr-2"></i>
                        {{ $banner['welcome_message'] }}
                    </span>
                </div>
            @endif
            
            <h2 class="text-2xl lg:text-3xl font-bold text-white mb-3">
                {{ $banner['title'] }}
            </h2>
            
            @if($banner['description'])
                <p class="text-white text-opacity-90 mb-4 text-lg">
                    {{ $banner['description'] }}
                </p>
            @endif
            
            @if($banner['button_text'] && $banner['button_url'])
                <a href="{{ $banner['button_url'] }}" 
                   class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl">
                    {{ $banner['button_text'] }}
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @endif
        </div>
    </div>
    
    <!-- Close Button -->
    <button onclick="closeBanner()" 
            class="absolute top-4 right-4 w-8 h-8 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full flex items-center justify-center text-white transition-all duration-200">
        <i class="fas fa-times text-sm"></i>
    </button>
</div>

<script>
function closeBanner() {
    const banner = document.getElementById('marketing-banner');
    if (banner) {
        banner.style.display = 'none';
        // Store in localStorage to remember user's preference
        localStorage.setItem('banner_closed', 'true');
    }
}

// Check if banner was previously closed
document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('banner_closed') === 'true') {
        const banner = document.getElementById('marketing-banner');
        if (banner) {
            banner.style.display = 'none';
        }
    }
});
</script>
@endif
