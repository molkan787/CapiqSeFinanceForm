<template>
    <div>
        <div class="header">
            <h1 class="grand-title">
                Välkommen till CapIQ F. Capital AB.
Just nu har vi följande emission/er tillgängliga.

            </h1>
        </div>
        <div class="container">
            <div v-if="!selectedOffer" class="loading-wrapper">
                <v-progress-circular
                    indeterminate
                    color="primary"
                ></v-progress-circular>
            </div>

            <div class="content">
                <div class="offers">
                    <div 
                        v-for="offer in offers" :key="offer.id"
                        class="item" :class="{active: offer.id === selectedOffer.id}"
                        >
                        <a href="#" @click="selectOffer(offer)" >
                            {{ offer.title }}
                        </a>
                    </div>
                </div>

                <div class="mycard" v-if="selectedOffer">
                    <h2>BESKRIVNING</h2>
                    <h4>{{ selectedOffer.title }}</h4>
                    <div class="pw">{{ selectedOffer.description }}</div>
                </div>

                <div class="mycard" v-if="selectedOffer">
                    <h2>VILLKOR</h2>
                    <div class="pw">{{ selectedOffer.terms }} </div>
                </div>

                <div class="mycard" v-if="selectedOffer">
                    <user-form
                        :bucket="dataBucket"
                        :offer="selectedOffer"
                        :form="formData"
                        @submit="onFormSubmitClick"
                        :submitButtonLoading="submitButtonLoading"
                    />
                </div>
            </div>
            <br />
            <br />

            <confirm-dialog
                @confirmed="onConfirmClick"
                @canceled="showConfirmationDialog = false"
                :priceText="totalText"
                :loading="confirmButtonLoading"
                :isOpen="showConfirmationDialog"
            />
        </div>
    </div>
</template>

<script>
import qs from "querystring";
import ConfirmDialog from "~/components/ConfirmDialog.vue";
import UserForm from "~/components/UserForm.vue";

export default {
    components: { UserForm, ConfirmDialog },
    computed: {
        selectedOffer() {
            return (
                this.us_selectedOffer || (this.offers && this.offers[0]) || null
            );
        },
        totalText() {
            return this.dataBucket.totalText;
        },
    },
    data: () => ({
        submitButtonLoading: false,
        us_selectedOffer: null,
        offers: null,
        formData: {},
        showConfirmationDialog: false,
        confirmButtonLoading: false,
        dataBucket: {
            totalText: "",
        },
        uat: "",
    }),
    methods: {
        async onFormSubmitClick() {
            this.submitButtonLoading = true;
            try {
                const formData = JSON.stringify(this.formData);
                window.localStorage.setItem("form_data", formData);
                window.localStorage.setItem(
                    "selected_offerId",
                    this.selectedOffer.id
                );
                const redirectUrl =
                    window.location.href.split("?")[0] + "?postSubmit=1";
                const { loginUrl } = await this.$api.requestAuthorizationCode(
                    redirectUrl
                );
                window.location.href = loginUrl;
            } catch (error) {
                console.error(error);
                alert("An error occured, Please try again");
            }
            this.submitButtonLoading = false;
        },
        async onConfirmClick() {
            this.confirmButtonLoading = true;
            await this.formSubmit();
            this.confirmButtonLoading = false;
        },
        async formSubmit() {
            const offer = this.selectedOffer;
            try {
                const {
                    title: offerTitle,
                    company: { name: companyName },
                } = this.selectedOffer;
                const info = {
                    companyName: companyName,
                    offerTitle: offerTitle,
                    totalPay: this.dataBucket.totalText,
                };
                const response = await this.$api.submitForm({
                    offerId: offer.id,
                    offerTitle: offer.title,
                    uat: this.uat,
                    info: info,
                    ...this.formData,
                });
                const success = response.statusCode === "OK";
                if (success) {
                    this.clearCachedState();
                    const eInfo = encodeURIComponent(
                        btoa(JSON.stringify(info))
                    );
                    const redirectTo = "/thankyou?info=" + eInfo;
                    window.location.href = redirectTo;
                }
            } catch (error) {
                console.error(error);
                alert("An error occured, Please try again");
            }
        },
        clearCachedState() {
            window.localStorage.removeItem("form_data");
            window.localStorage.removeItem("selected_offerId");
        },
        selectOffer(offer) {
            this.us_selectedOffer = offer;
        },
        clearForm() {
            this.formData = {
                invest_data: 1,
                jag: "firma",
                organisationsnummer: "",
                kvarifran: "siab",
                vanligen_beskriv: "",
                personnummer: "",
                e_post: "",
                mobiltelefon: "",
                mitt_namn: "",
                chvarifran: false,
                ange_clearing: "",
                ange_kontonummer: "",
                varifran: false,
                personer_med1: "",
                personer_med2: "",
                personer_med3: "",
                personer_med4: "",
                agande1: null,
                agande2: null,
                agande3: null,
                agande4: null,
                units: 1,
            };
        },
    },
    async mounted() {
        if (process.client) {
            const params = qs.parse(window.location.href.split("?")[1] || "");
            console.log(params);
            let offerId = null;
            if (params.postSubmit === "1") {
                const formData = JSON.parse(
                    window.localStorage.getItem("form_data")
                );
                offerId = window.localStorage.getItem("selected_offerId");
                this.formData = formData;
                if (params.status === "done") {
                    this.uat = params.uat;
                    setTimeout(() => {
                        try {
                            document
                                .getElementById("formSubmitBtn")
                                .scrollIntoView();
                        } catch (error) {}
                        this.showConfirmationDialog = true;
                    }, 1000);
                } else {
                    alert(
                        "Access to your account was declined or an error occured, Please try submiting again"
                    );
                }
            } else {
                this.clearForm();
            }
            this.offers = await this.$api.getInvestmentProposal();
            if (offerId) {
                const offerIndex = this.offers.findIndex(
                    (o) => o.id === offerId
                );
                this.us_selectedOffer = this.offers[offerIndex];
            }
        }
    },
};
</script>

<style lang="scss">
$primary: #111;
$colorVar1: #35495e;
$colorVar2: #467977;
.header {
    background-image: url("~/assets/images/subpage-pattern-bg.png");
    background-repeat: repeat;
    height: 6rem;
    text-align: center;
    padding: 1.7rem;
    opacity: 0.9;
}
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
    color: $primary;
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
        background: #f5f5f5;
        border: 1px solid #f0f0f0;
        margin-bottom: 3px;
        a{
            text-decoration: none;
            display: block;
            padding: 10px;
            color: #111;
            font-size: 16px;
            font-weight: 500;
            &:hover {
                color: $colorVar2;
            }
        }
        &.active{
            background-color: #89C53F;
            a{
                color: white;
            }
        }
    }
}

.loading-wrapper {
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
.mycard{
    max-width: 840px;
    margin: 0 auto;
    box-shadow: 0 0 20px rgb(0 0 0 / 10%);
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #f0f0f0;
    font-size: 16px;

    h2{
        margin-bottom: 1rem;
    }
    h4{
        margin-bottom: 5px;
    }
}

.pw{
    white-space: pre-wrap;
}
.v-card__title {
    color: #232f3b !important;
}
.v-card__text {
    color: rgba(#232f3b, 0.9) !important;
}
.v-input__slot{
    border-radius: 0 !important;
    input{
        font-weight: 300;
    }
}
.v-text-field--outlined{
    fieldset{
        border: 1px solid #d8d8d8 !important;
    }
    &.v-input--is-focused fieldset{
        border-color: #89c53f !important;
    }
}
.v-radio, .v-input--checkbox {
    label{
        color: $primary !important;
        font-weight: 300;
    }
}
</style>
