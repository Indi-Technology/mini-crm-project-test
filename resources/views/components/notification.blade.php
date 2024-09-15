@props(['type' => 'info', 'message'])

@php
    $typeClasses = [
        'info' => 'bg-blue-100 text-blue-800',
        'success' => 'bg-green-100 text-green-800',
        'warning' => 'bg-yellow-100 text-yellow-800',
        'error' => 'bg-red-100 text-red-800',
    ];
@endphp

<div id="notification"
    class="z-50 fixed top-4 right-4 p-4 mb-4 text-sm rounded-lg {{ $typeClasses[$type] ?? $typeClasses['info'] }}"
    role="alert">
    {{ $message }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.transition = 'opacity 0.5s ease';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }
        }, 5000);
    });
</script>
