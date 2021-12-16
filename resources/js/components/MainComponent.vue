<template>
    <div class="container">
        <h1 class="my-4">NASA api</h1>

        <div class="d-flex my-5">
            <div class="w-100 me-3">
                <label class="typo__label">Categories</label>
                <Multiselect
                    @input="selectCategory"
                    placeholder="Choose category"
                    label="title"
                    track-by="id"
                    :multiple="true"
                    :taggable="true"
                    v-model="selected_categories"
                    :options="getCategories"
                />
            </div>

            <select class="form-select mt-4"
                    @change="changeAmount"
                    aria-label="Default select example"
                    v-model="amount">
                <option selected disabled>Choose amount of events</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">On Google maps</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="event in getEvents" :key="event.id">
                    <th scope="row">{{ event.title }}</th>
                    <td>{{ event.date | parseDate }}</td>
                    <td>
                        <a target="_blank" :href="event.lat | parseLink(event.long)">Go by link</a>
                    </td>
                </tr>
            </tbody>

        </table>
        <b-pagination
            @change="pagination"
            class="d-flex"
            v-model="currentPage"
            :per-page="amount"
            :total-rows="getEventsCount"
            prev-text="Prev"
            next-text="Next"
        ></b-pagination>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import { mapActions, mapGetters, mapMutations } from 'vuex'

    export default {
        name: 'MainComponent',
        components: {
            Multiselect,
        },
        mounted() {

            this.loadCategories()

            this.loadEvents({
                current: this.currentPage,
                limit: this.amount
            })
        },
        filters: {
            parseDate: time => {
                return new Date(time).toLocaleDateString('en-GB')
            },
            parseLink: function (lat, long) {
                return 'https://www.google.com/maps/search/?api=1&query=' + lat + ',' + long
            }
        },
        computed: {
            ...mapGetters(['getEvents', 'getCategories', 'getEventsCount']),
        },
        data() {
            return {
                currentPage: 1,
                amount: 10,
                selected_categories: null,
            }
        },
        methods: {
            ...mapMutations(['SET_EVENTS', 'SET_CATEGORIES']),

            ...mapActions(['loadCategories', 'loadEvents']),

            changeAmount() {

                this.loadEvents({
                    current: this.currentPage,
                    limit: this.amount,
                    categories: this.selected_categories
                })
            },

            selectCategory() {
                this.loadEvents({
                    current: this.currentPage,
                    limit: this.amount,
                    categories: this.selected_categories
                })
            },

            pagination(page) {

                this.loadEvents({
                    current: page,
                    limit: this.amount,
                    categories: this.selected_categories
                })
            }
        }
    }
</script>


<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


<style scoped lang="css">
    .form-select {
        width: 255px;
    }
</style>
