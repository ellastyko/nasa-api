<template>
        <div>PPP</div>
<!--    <div class="container">-->
<!--        <h1 class="my-4">NASA api</h1>-->

<!--        <div class="d-flex my-5">-->
<!--            <div class="w-100 me-3">-->
<!--                <label class="typo__label">Categories</label>-->
<!--                <Multiselect-->
<!--                    @input="selectCategory"-->
<!--                    placeholder="Choose category"-->
<!--                    label="title"-->
<!--                    track-by="id"-->
<!--                    :multiple="true"-->
<!--                    :taggable="true"-->
<!--                    v-model="selected_categories"-->
<!--                    :options="getCategories"-->
<!--                />-->
<!--            </div>-->

<!--            <select class="form-select mt-4"-->
<!--                    @change="changeAmmount"-->
<!--                    aria-label="Default select example"-->
<!--                    v-model="ammount">-->
<!--                <option selected disabled>Choose ammount of events</option>-->
<!--                <option value="5">5</option>-->
<!--                <option value="10">10</option>-->
<!--                <option value="20">20</option>-->
<!--            </select>-->
<!--        </div>-->

<!--        <table class="table">-->
<!--            <thead>-->
<!--                <tr>-->
<!--                    <th scope="col">Title</th>-->
<!--                    <th scope="col">Date</th>-->
<!--                    <th scope="col">On Google maps</th>-->
<!--                </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--                <tr v-for="event in getEvents" :key="event.id">-->
<!--                    <th scope="row">{{ event.title }}</th>-->
<!--                    <td>{{ event.date | parseDate }}</td>-->
<!--                    <td>-->
<!--                        <a target="_blank"-->
<!--                           :href="'https://www.google.com/maps/search/?api=1&query=' + event.lat + ',' + event.lng">Go by link</a>-->
<!--                    </td>-->
<!--                </tr>-->
<!--            </tbody>-->

<!--        </table>-->
<!--        <b-pagination-->
<!--            @change="pagination"-->
<!--            class="d-flex"-->
<!--            v-model="currentPage"-->
<!--            :per-page="ammount"-->
<!--            :total-rows="getEventsCount"-->
<!--            prev-text="Prev"-->
<!--            next-text="Next"-->
<!--        ></b-pagination>-->

<!--    </div>-->
</template>

<script>
    // import Multiselect from 'vue-multiselect'
    // import { mapActions, mapGetters, mapMutations } from 'vuex'
    //
    export default {
        name: 'main-component',
    //     components: {
    //         Multiselect,
    //     },
    //     mounted() {
    //
    //         this.loadCategories()
    //
    //         this.loadEvents({
    //             current: this.currentPage,
    //             limit: this.ammount
    //         })
    //     },
    //     filters: {
    //         parseDate: time => {
    //             return new Date(time).toLocaleDateString('en-GB')
    //         }
    //     },
    //     computed: {
    //         ...mapGetters(['getEvents', 'getCategories', 'getEventsCount']),
    //     },
    //     data() {
    //         return {
    //             currentPage: 1,
    //             ammount: 10,
    //             selected_categories: null,
    //         }
    //     },
    //     methods: {
    //         ...mapMutations(['SET_EVENTS', 'SET_CATEGORIES']),
    //
    //         ...mapActions(['loadCategories', 'loadEvents']),
    //
    //         changeAmmount() {
    //
    //             this.loadEvents({
    //                 current: this.currentPage,
    //                 limit: this.ammount,
    //                 categories: this.selected_categories
    //             })
    //         },
    //
    //         selectCategory() {
    //
    //             this.loadEvents({
    //                 current: this.currentPage,
    //                 limit: this.ammount,
    //                 categories: this.selected_categories
    //             })
    //         },
    //
    //         pagination(page) {
    //
    //             this.loadEvents({
    //                 current: page,
    //                 limit: this.ammount,
    //                 categories: this.selected_categories
    //             })
    //         }
    //     }
    }
</script>


<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


<style scoped lang="scss">
    .form-select {
        width: 255px;
    }
</style>
