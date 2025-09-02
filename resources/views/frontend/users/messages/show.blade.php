<div class="space-y-6">
    <!-- Message Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold text-gray-800">{{ $message->subject }}</h4>
                <p class="text-sm text-gray-600">Sent to Admin on {{ $message->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div class="text-right">
                @php
                    $statusColors = [
                        'unread' => 'bg-red-100 text-red-800',
                        'read' => 'bg-yellow-100 text-yellow-800',
                        'replied' => 'bg-green-100 text-green-800'
                    ];
                    $statusColor = $statusColors[$message->status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                    {{ ucfirst($message->status) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Order Information -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <h5 class="font-semibold text-blue-800 mb-2">Order Information</h5>
        <p class="text-sm text-blue-700">Order Group: <span class="font-mono">{{ $message->order_group }}</span></p>
    </div>

    <!-- Your Message -->
    <div>
        <h5 class="font-semibold text-gray-800 mb-3">Your Message</h5>
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
            <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
        </div>
    </div>

    <!-- Admin Reply (if exists) -->
    @if($message->admin_reply)
    <div>
        <h5 class="font-semibold text-gray-800 mb-3 flex items-center">
            <i class="fas fa-reply text-green-600 mr-2"></i>
            Admin Reply
        </h5>
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-lg p-4 shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-tie text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-gray-700 whitespace-pre-wrap font-medium">{{ $message->admin_reply }}</p>
                    <div class="flex items-center mt-3 text-xs text-gray-500">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Replied on: {{ $message->replied_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-white text-sm"></i>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-yellow-800 text-sm font-medium">Admin hasn't replied yet</p>
                <p class="text-yellow-700 text-xs mt-1">You'll see their response here once they do.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Status Information -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
        <h5 class="font-semibold text-gray-800 mb-2">Message Status</h5>
        <div class="space-y-2">
            @if($message->status === 'unread')
                <p class="text-sm text-gray-600">📧 <span class="font-medium">Unread</span> - Admin hasn't seen your message yet</p>
            @elseif($message->status === 'read')
                <p class="text-sm text-gray-600">👁️ <span class="font-medium">Read</span> - Admin has seen your message</p>
            @elseif($message->status === 'replied')
                <p class="text-sm text-gray-600">✅ <span class="font-medium">Replied</span> - Admin has responded to your message</p>
            @endif
        </div>
    </div>
</div>
