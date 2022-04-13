<template>
    <div class="inline">
        <a href="#" class="text-md mx-1" @click.prevent="toggleModalOpened">
            <i class="fas fa-trash"></i>
        </a>

        <form :action="url" method="post" class="inline" ref="formDelete">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" :value="token">
        </form>
    </div>
</template>

<script>
export default {
    props: {
        url: {
            type: String,
            required: true
        },
        token: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            modalOpened: false
        };
    },

    methods: {
        toggleModalOpened() {
            this.modalOpened = !this.modalOpened;
        },

        submit() {
            this.$refs.formDelete.submit();
        }
    }
}
</script>
