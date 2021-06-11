<template>
    <div class="user-form">
        <!-- <div class="form-group">
            <label>Antal poster á 2500 kr</label>
            <v-text-field
                type="number"
                dense
                hide-details
                outlined
                style="width: 120px"
                v-model.number="form.invest_data"
            />
            <p>
                Totalt att investera: 2500 kr <br />
                Utdelning per år: 175 kr <br />
                Avkastning per månad: 15kr
            </p>
        </div> -->

        <div class="form-group">
            <label class="ivmr">Jag investerar som <span>*</span> </label>
            <v-radio-group v-model="form.jag">
                <v-radio
                    label="Privatperson eller enskild firma"
                    value="firma"
                />
                <v-radio label="AB, HB eller KB" value="abhbkb" />
            </v-radio-group>
        </div>

        <template v-if="form.jag == 'abhbkb'">
            <div class="form-group">
                <label>Organisationsnummer</label>
                <v-text-field v-model="form.organisationsnummer" outlined dense placeholder="Organisationsnummer XXXXXX-XXXX" />
            </div>

            <div class="form-group">
                <label>Verklig huvudman <span>*</span></label>
                <v-row style="padding: 0 0.5rem">
                    <v-col cols="12" md="9">
                        <div class="form-group">
                            <label>Personer med 25% ägande eller mer</label>
                            <v-text-field v-model="form.personer_med1" outlined dense hide-details placeholder="Personnummer ÅÅÅÅMMDD-XXXX" />
                            <v-text-field v-model="form.personer_med2" outlined dense hide-details placeholder="Personnummer ÅÅÅÅMMDD-XXXX" />
                            <v-text-field v-model="form.personer_med3" outlined dense hide-details placeholder="Personnummer ÅÅÅÅMMDD-XXXX" />
                            <v-text-field v-model="form.personer_med4" outlined dense hide-details placeholder="Personnummer ÅÅÅÅMMDD-XXXX" />
                        </div>
                    </v-col>
                    <v-col cols="12" md="3">
                        <div class="form-group">
                            <label>Ägande</label>
                            <v-text-field v-model.number="form.agande1" outlined dense hide-details type="number" placeholder="%" />
                            <v-text-field v-model.number="form.agande2" outlined dense hide-details type="number" placeholder="%" />
                            <v-text-field v-model.number="form.agande3" outlined dense hide-details type="number" placeholder="%" />
                            <v-text-field v-model.number="form.agande4" outlined dense hide-details type="number" placeholder="%" />
                        </div>
                    </v-col>
                </v-row>
            </div>
        </template>

        <div class="form-group">
            <label>Mina personuppgifter <span>*</span></label>
            <v-text-field
                outlined
                dense
                placeholder="Personnummer ÅÅÅÅMMDD-XXXX"
                style="margin-bottom: 0.3rem"
                v-model="form.personnummer"
                :error-messages="errors.personnummer"
                :hide-details="!errors.personnummer"
            />
            <v-text-field
                outlined
                dense
                placeholder="e-post"
                v-model="form.e_post"
                :error-messages="errors.e_post"
                :hide-details="!errors.e_post"
                style="margin-bottom: 0.3rem"
            />
            <v-text-field
                outlined
                dense
                placeholder="Mobiltelefon"
                v-model="form.mobiltelefon"
                :error-messages="errors.mobiltelefon"
                :hide-details="!errors.mobiltelefon"
                style="margin-bottom: 0.3rem"
            />
            <v-text-field
                outlined
                dense
                placeholder="Mitt namn"
                v-model="form.mitt_namn"
                :error-messages="errors.mitt_namn"
                :hide-details="!errors.mitt_namn"
            />
        </div>

        <div class="form-group">
            <label>Varifrån kommer de investerade pengarna?</label>
            <v-radio-group v-model="form.kvarifran">
                <v-radio
                    v-for="opt in kvarifranOptions" :key="opt.value"
                    :label="opt.label"
                    :value="opt.value"
                />
            </v-radio-group>
        </div>

        <div v-if="form.kvarifran == 'aannat'" class="form-group">
            <label>Vänligen beskriv var pengarna kommer från</label>
            <v-textarea v-model="form.vanligen_beskriv" outlined dense hide-details/>
        </div>

        <div class="form-group">
            <v-checkbox
                v-model="form.chvarifran"
                label="Person med politiskt utsatt ställning PEP finns"
            />
        </div>

        <div class="form-group">
            Ange ditt konto för automatisk utbetalning av utdelning:
        </div>

        <v-row>
            <v-col cols="12" md="2">
                <div class="form-group">
                    <label>Clearing <span>*</span></label>
                    <v-text-field
                        v-model="form.ange_clearing"
                        :error-messages="errors.ange_clearing"
                        :hide-details="!errors.ange_clearing"
                        outlined
                        dense
                        maxlength="4"
                    />
                </div>
            </v-col>
            <v-col cols="12" md="10">
                <div class="form-group">
                    <label>Kontonummer <span>*</span></label>
                    <v-text-field
                        v-model="form.ange_kontonummer"
                        :error-messages="errors.ange_kontonummer"
                        :hide-details="!errors.ange_kontonummer"
                        outlined
                        dense
                    />
                </div>
            </v-col>
        </v-row>

        <div style="width:100%;height:2rem"></div>

        <div class="form-group">
            <h2>Teckna</h2>
            <label>Pris:</label> <span>{{ priceText }} / Unit</span> <br>
            <span>Du tecknar som {{ form.mitt_namn }} (you)</span>
        </div>

        <v-row>
            <v-col cols="12" md="2">
                <div class="form-group">
                    <label>Units</label>
                    <v-text-field
                        v-model.number="form.units"
                        :error-messages="errors.units"
                        :hide-details="!errors.units"
                        outlined
                        dense
                        type="number"
                        min="1"
                    />
                </div>
            </v-col>
            <v-col cols="12" md="10">
                <div class="form-group">
                    <label>Total</label>
                    <v-text-field
                        :value="totalText"
                        hide-details
                        outlined
                        dense
                        readonly
                    />
                </div>
            </v-col>
        </v-row>

        <div class="form-group">
            <v-checkbox
                v-model="form.varifran"
                :error-messages="errors.varifran"
            >
                <template #label>
                    Jag har läst och förstått&nbsp;<a @click.stop href="https://capiq.se/allmanna-villkor/" target="_blank">villkoren</a>
                </template>
            </v-checkbox>
        </div>

        <v-btn @click="sendClick" :loading="submitButtonLoading" id="formSubmitBtn" color="#89C53F" tile>Slutför</v-btn>

    </div>
</template>

<script>
export default {
    props: {
        form: {
            type: Object,
            required: true
        },
        offer: {
            type: Object,
        },
        submitButtonLoading: {
            type: Boolean,
            default: false
        },
        bucket: {
            type: Object,
            default: () => ({})
        }
    },
    computed: {
        totalText(){
            if(!this.offer) return ''
            return `${this.total} ${this.currencyCode}`
        },
        priceText(){
            if(!this.offer) return ''
            const { price: { amountFloat } } = this.offer;
            return `${amountFloat.toFixed(2)} ${this.currencyCode}`
        },
        total(){
            if(!this.offer) return 0
            const { price: { amountFloat } } = this.offer
            return amountFloat * this.form.units
        },
        currencyCode(){
            if(!this.offer) return ''
            const { price: { currency: { code } } } = this.offer
            return code
        }
    },
    watch: {
        totalText: {
            immediate: true,
            handler(txt){
                this.bucket.totalText = txt
            }
        }
    },
    data: () => ({
        array4: [1, 2, 3, 4],
        errors: {
            personnummer: null,
            e_post: null,
            mobiltelefon: null,
            mitt_namn: null,
            ange_clearing: null,
            ange_kontonummer: null,
            varifran: null,
            units: ''
        },
        kvarifranOptions: [
            {
                value: "siab",
                label: "Sparande i annan bank",
            },
            {
                value: "vinva",
                label: "Vinst värdepapper",
            },
            {
                value: "forfor",
                label: "Företagsförsäljning",
            },
            {
                value: "fastfor",
                label: "Fastighetsförsäljning",
            },
            {
                value: "faat",
                label: "Försäljning av andra tillgångar",
            },
            {
                value: "vifor",
                label: "Vinst i företag",
            },
            {
                value: "aannat",
                label: "Annat",
            },
        ],
    }),
    methods: {
        validateForm(){
            const props = [
                'personnummer',
                'e_post',
                'mobiltelefon',
                'mitt_namn',
                'ange_clearing',
                'ange_kontonummer'
            ]
            const errorMsg = 'Det här är ett obligatoriskt fält';
            for(let prop of props){
                const value = this.form[prop].trim()
                this.errors[prop] = value ? null : [errorMsg]
            }
            this.errors.varifran = this.form.varifran ? null : [errorMsg]
            this.errors.units = this.form.units > 0 ? null : [errorMsg]

            const hasAnyErrors = Object.values(this.errors).reduce((bag, val) => (bag || val), false)
            return !hasAnyErrors;
        },
        sendClick(){
            if(this.validateForm()){
                this.$emit('submit');
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.form-group {
    &:not(:last-child) {
        margin-bottom: 1rem;
    }
    & > label {
        font-weight: 600;
        color: #111;
        font-size: 16px;
        display: inline-block;
        margin-bottom: 0.5rem;
        &.ivmr {
            margin-bottom: -0.5rem;
        }
        span {
            color: red;
        }
    }
}
</style>

<style lang="scss">
.form-group{
    input{
        color: #333;
    }
}
#formSubmitBtn{
    box-shadow: none !important;
    background-color: #89c53f !important;
    border-color: transparent !important;
    padding: 12px 18px !important;
    color: #fff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    line-height: 18px !important;
    text-transform: uppercase !important;
    transition: all 0.3s ease-in-out 0s !important;
    border-radius: 0 !important;
    height: 46px;
}
</style>