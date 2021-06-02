<template>
    <div class="container">
        <h1 class="grand-title">
            Welcome to us, for the moment we have the following offers
        </h1>

        <div v-if="!selectedOffer" class="loading-wrapper">
            <v-progress-circular
                indeterminate
                color="primary"
            ></v-progress-circular>
        </div>

        <div class="content">
            <div class="offers">
                <a
                    class="item"
                    v-for="offer in offers"
                    :key="offer.id"
                    href="#"
                    @click="selectOffer(offer)"
                >
                    <h3>{{ offer.title }}</h3>
                </a>
            </div>

            <v-card v-if="selectedOffer">
                <v-card-title>BESKRIVNING</v-card-title>
                <v-card-text>
                    <h4> {{ selectedOffer.title }} </h4>
                    {{ selectedOffer.description }}
                </v-card-text>
            </v-card>
            
            <v-card v-if="selectedOffer">
                <v-card-title>VILLKOR</v-card-title>
                <v-card-text> {{ selectedOffer.terms }} </v-card-text>
            </v-card>

            <v-card v-if="selectedOffer">
                <v-card-text>
                    <user-form />
                </v-card-text>
            </v-card>

        </div>
    </div>
</template>

<script>
// import { mapState } from "vuex";
import UserForm from '~/components/UserForm.vue';

export default {
    components: { UserForm },
    computed: {
        // ...mapState(["offers"]),
        selectedOffer(){
            return this.us_selectedOffer || (this.offers && this.offers[0]) || null;
        }
    },
    data: () => ({
        us_selectedOffer: null,
        offers: null
    }),
    methods: {
        selectOffer(offer){
            this.us_selectedOffer = offer;
        }
    },
    async created(){
        this.offers = await this.$api.getInvestmentProposal();
    }
};
</script>

<style lang="scss">
$primary: #34495E;
$colorVar1: #35495e;
$colorVar2: #467977;
.container {
    margin: 0 auto;
    min-height: 100vh;
    max-width: 1100px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    padding: 2rem;
    color: $primary;
}

.grand-title {
    margin-bottom: 2rem;
}

.content {
    width: 100%;
    max-width: 800px;
    & > div {
        margin-bottom: 1rem;
    }
}

.offers {
    width: 100%;
    .item {
        text-decoration: none;
        color: $primary;
        &:hover {
            color: $colorVar2;
        }
    }
}

.loading-wrapper{
    display: flex;
    height: 85vh;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.title {
    font-family: "Quicksand", "Source Sans Pro", -apple-system,
        BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
        sans-serif;
    display: block;
    font-weight: 300;
    font-size: 100px;
    color: #35495e;
    letter-spacing: 1px;
}

.subtitle {
    font-weight: 300;
    font-size: 42px;
    color: #526488;
    word-spacing: 5px;
    padding-bottom: 15px;
}
.v-card__title{
    color: #232f3b !important;
}
.v-card__text{
    color: rgba(#232f3b, 0.9) !important;
}
</style>
