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
                hide-details
                placeholder="Personnummer ÅÅÅÅMMDD-XXXX"
                style="margin-bottom: 0.3rem"
            />
            <v-text-field
                outlined
                dense
                hide-details
                placeholder="e-post"
                style="margin-bottom: 0.3rem"
            />
            <v-text-field
                outlined
                dense
                hide-details
                placeholder="Mobiltelefon"
                style="margin-bottom: 0.3rem"
            />
            <v-text-field outlined dense hide-details placeholder="Mitt namn" />
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
                    <v-text-field v-model="form.ange_clearing" outlined dense hide-details maxlength="4" />
                </div>
            </v-col>
            <v-col cols="12" md="10">
                <div class="form-group">
                    <label>Kontonummer <span>*</span></label>
                    <v-text-field v-model="form.ange_kontonummer" outlined dense hide-details maxlength="4" />
                </div>
            </v-col>
        </v-row>

        <div class="form-group">
            <v-checkbox
                v-model="form.varifran"
                label="Jag har läst och förstått villkoren"
            />
        </div>

        <v-btn color="#8DDECE">SKICKA</v-btn>

    </div>
</template>

<script>
export default {
    data: () => ({
        array4: [1, 2, 3, 4],
        form: {
            invest_data: 1,
            jag: "firma",
            organisationsnummer: '',
            kvarifran: 'siab',
            vanligen_beskriv: '',
            chvarifran: false,
            ange_clearing: '',
            ange_kontonummer: '',
            varifran: false,
            personer_med1: '',
            personer_med2: '',
            personer_med3: '',
            personer_med4: '',
            agande1: null,
            agande2: null,
            agande3: null,
            agande4: null,
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
};
</script>

<style lang="scss" scoped>
.form-group {
    &:not(:last-child) {
        margin-bottom: 1rem;
    }
    & > label {
        font-weight: bold;
        font-size: 1rem;
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