<template>
    <div class="fixed top-4 right-4 z-50 max-w-md transform transition-all duration-300 ease-in-out">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-xl flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="font-medium">{{ success }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        success: String
    }
};
</script>