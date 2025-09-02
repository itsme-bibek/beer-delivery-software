<div class="space-y-6">
    <!-- Message Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold text-gray-800">{{ $message->subject }}</h4>
                <p class="text-sm text-gray-600">From: {{ $message->user->name }} ({{ $message->user->email }})</p>
            </div>
            <div class="text-right">
                <span class="text-sm text-gray-500">{{ $message->created_at->format('M d, Y H:i') }}</span>
                @php
                    $statusColors = [
                        'unread' => 'bg-red-100 text-red-800',
                        'read' => 'bg-yellow-100 text-yellow-800',
                        'replied' => 'bg-green-100 text-green-800'
                    ];
                    $statusColor = $statusColors[$message->status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
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

    <!-- Customer Message -->
    <div>
        <h5 class="font-semibold text-gray-800 mb-3">Customer Message</h5>
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
            <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
        </div>
    </div>

    <!-- Admin Reply (if exists) -->
    @if($message->admin_reply)
    <div>
        <h5 class="font-semibold text-gray-800 mb-3">Admin Reply</h5>
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <p class="text-gray-700 whitespace-pre-wrap">{{ $message->admin_reply }}</p>
            <p class="text-xs text-gray-500 mt-2">Replied on: {{ $message->replied_at->format('M d, Y H:i') }}</p>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
        @if($message->status === 'unread')
        <button onclick="markAsRead({{ $message->id }})"
            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
            <i class="fas fa-check mr-2"></i>Mark as Read
        </button>
        @endif
        
        @if($message->status !== 'replied')
        <button onclick="replyToMessage({{ $message->id }})"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-reply mr-2"></i>Reply
        </button>
        @endif
    </div>
</div>
