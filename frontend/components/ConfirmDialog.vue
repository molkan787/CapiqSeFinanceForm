<template>
    <v-dialog :value="isOpen" width="500">
        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                Vänligen bekräfta teckningsanmälan
            </v-card-title>

            <v-card-text>
                Vänligen bekräfta antalet tecknade units och att du tagit del av de bindande villkoren för erbjudandet. Likvid att erlägga för denna transaktion är {{ priceText }} SEK
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-btn :loading="loading" @click="$emit('confirmed')" color="#1867C0" style="margin-right:1rem;width:120px;box-shadow:none" tile class="white--text">
                    Bekräfta
                </v-btn>
                <v-btn :disabled="loading" @click="$emit('canceled')" color="#DD3333" style="margin-right:1rem;width:120px;box-shadow:none" tile class="white--text">
                    Avbryt
                </v-btn>
                <!-- <v-spacer></v-spacer> -->
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        isOpen: {
            type: Boolean,
            default: true
        },
        priceText: {
            type: String,
            default: 'XXX CC'
        },
        loading: {
            type: Boolean,
            default: false
        }
    }
}
</script>