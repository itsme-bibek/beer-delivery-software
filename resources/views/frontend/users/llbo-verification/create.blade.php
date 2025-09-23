@extends('layout.app')

@section('main')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex items-center justify-between">
                            <div>
                                <h6 class="text-lg font-semibold text-gray-800">Submit LLBO License</h6>
                                <p class="text-sm text-slate-500 mt-1">Upload your LLBO license for verification</p>
                            </div>
                            <a href="{{ route('user.llbo-verification.index') }}" 
                               class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex-auto p-6">
                        <form action="{{ route('user.llbo-verification.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- License Details -->
                                <div class="space-y-6">
                                    <h6 class="text-lg font-semibold text-gray-800">License Details</h6>
                                    
                                    <div>
                                        <label for="license_number" class="block text-sm font-medium text-gray-700 mb-2">License Number *</label>
                                        <input type="text" 
                                               id="license_number" 
                                               name="license_number" 
                                               value="{{ old('license_number') }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('license_number') border-red-500 @enderror"
                                               placeholder="Enter your license number"
                                               required>
                                        @error('license_number')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="license_type" class="block text-sm font-medium text-gray-700 mb-2">License Type *</label>
                                        <select id="license_type" 
                                                name="license_type" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('license_type') border-red-500 @enderror"
                                                required>
                                            <option value="">Select license type</option>
                                            <option value="LLBO" {{ old('license_type') == 'LLBO' ? 'selected' : '' }}>LLBO</option>
                                            <option value="Retail" {{ old('license_type') == 'Retail' ? 'selected' : '' }}>Retail</option>
                                            <option value="Wholesale" {{ old('license_type') == 'Wholesale' ? 'selected' : '' }}>Wholesale</option>
                                        </select>
                                        @error('license_type')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="issue_date" class="block text-sm font-medium text-gray-700 mb-2">Issue Date *</label>
                                        <input type="date" 
                                               id="issue_date" 
                                               name="issue_date" 
                                               value="{{ old('issue_date') }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('issue_date') border-red-500 @enderror"
                                               required>
                                        @error('issue_date')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-2">Expiry Date *</label>
                                        <input type="date" 
                                               id="expiry_date" 
                                               name="expiry_date" 
                                               value="{{ old('expiry_date') }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('expiry_date') border-red-500 @enderror"
                                               required>
                                        @error('expiry_date')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Document Upload -->
                                <div class="space-y-6">
                                    <h6 class="text-lg font-semibold text-gray-800">Document Upload</h6>
                                    
                                    <div>
                                        <label for="license_document" class="block text-sm font-medium text-gray-700 mb-2">License Document *</label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                            <div class="space-y-1 text-center">
                                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="license_document" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                        <span>Upload a file</span>
                                                        <input id="license_document" 
                                                               name="license_document" 
                                                               type="file" 
                                                               accept=".pdf,.jpg,.jpeg,.png"
                                                               class="sr-only @error('license_document') border-red-500 @enderror"
                                                               required>
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PDF, PNG, JPG up to 5MB</p>
                                            </div>
                                        </div>
                                        <div id="file-info" class="mt-2 text-sm text-gray-600"></div>
                                        @error('license_document')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <!-- Information Box -->
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-info-circle text-blue-400"></i>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-blue-800">Verification Process</h3>
                                                <div class="mt-2 text-sm text-blue-700">
                                                    <ul class="list-disc list-inside space-y-1">
                                                        <li>Your license will be reviewed within 1-2 business days</li>
                                                        <li>You'll receive an email notification once verified</li>
                                                        <li>Make sure the document is clear and readable</li>
                                                        <li>License must be valid and not expired</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="mt-8 flex justify-end">
                                <button type="submit" 
                                        class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-8 py-3 rounded-lg text-white font-semibold hover:shadow-lg transition-all">
                                    <i class="fas fa-paper-plane mr-2"></i>Submit for Verification
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('license_document');
    const uploadArea = fileInput.closest('.border-dashed');
    const fileInfo = document.getElementById('file-info');
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            uploadArea.classList.remove('border-gray-300');
            uploadArea.classList.add('border-blue-500', 'bg-blue-50');
            const fileName = file.name;
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            if (fileInfo) {
                fileInfo.innerHTML = `<span class="text-gray-800 font-medium">Selected:</span> ${fileName} <span class="text-gray-500">(${fileSize} MB)</span> <button type="button" onclick="resetFileInput()" class="ml-2 text-xs text-blue-600 hover:text-blue-500">Change</button>`;
            }
        }
    });
    
    // Drag and drop functionality
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('border-blue-500', 'bg-blue-50');
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
        uploadArea.classList.add('border-gray-300');
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });
});

function resetFileInput() {
    const fileInput = document.getElementById('license_document');
    const uploadArea = fileInput.closest('.border-dashed');
    const fileInfo = document.getElementById('file-info');
    
    fileInput.value = '';
    uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
    uploadArea.classList.add('border-gray-300');
    if (fileInfo) {
        fileInfo.innerHTML = '';
    }
}
</script>
@endsection
