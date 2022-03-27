<template>
    <div>
        Welcome {{ name }}

        <button @click="run_job()"> Run Job</button>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    data() {
        return {
            name: null,
        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    },
    methods: {
        run_job(){
            console.log('hi');
            var that = this;
            axios.get("/api/get_title").then(function (response) {
                console.log('done');
            });
        }
    }
   
}
</script>