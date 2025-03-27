<template>
    <div class="fixed top-0 left-0 right-0 bg-red-500 text-white p-4 text-center">
        {{ error }}
    </div>
</template>

<script>
export default {
    props: {
        error: String
    }
};
</script>