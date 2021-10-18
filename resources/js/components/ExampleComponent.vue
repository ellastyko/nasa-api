<template>
    <div class="container">

    </div>
</template>

<script>
    import axios from 'axios'

    export default {

        async created() {
            this.fetchData()
        },
        methods: {
            async fetchData() {
                axios.get('/api/companies', {
                    headers: { 
                        'Authorization': `Bearer ` + '1|aP9OX8hwLSJ37RUt9fvz9St7uFgD2mkuuAZ6MaaU'
                    }
                })
                .then(response => {
                    console.log(response)

                })
                .catch(error => {
                    console.log(error.response)
                })
            }
        }
    }
</script>
