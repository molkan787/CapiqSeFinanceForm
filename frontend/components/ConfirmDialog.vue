<template>
    <v-dialog :value="isOpen" width="500">
        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                Confirm subscription details
            </v-card-title>

            <v-card-text>
                Please confirm the subscription of the amount of units you have selected and that you hereby adhere to the legally binding conditions. Price for this transaction will be {{ priceText }}
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-btn :loading="loading" @click="$emit('confirmed')" color="#1867C0" style="margin-right:1rem;width:120px" class="white--text">
                    Yes
                </v-btn>
                <v-btn :disabled="loading" @click="$emit('canceled')" color="#DD3333" style="margin-right:1rem;width:120px" class="white--text">
                    Cancel
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