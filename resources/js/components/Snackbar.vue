<template>
    <div>
        <div :class="[this.success ? 'success' : 'failed', 'snackbar']">
            {{ this.message }}
        </div>
    </div>
</template>

<script>

export default {
    props: {
        show: Boolean,
        success: Boolean,
        message: String,
    },
    methods: {
    },
};
</script>

<style scoped>
.snackbar {
    padding:20px;
    color:white;
    text-align: center;
    font-weight: bold;
}
.success {
    background-color: rgba(0,0,0,0.8);
}
.failed {
    background-color: rgba(131, 0, 0, 0.8)
}
</style>
