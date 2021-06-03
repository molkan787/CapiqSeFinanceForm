<template>
    <div class="admin-settings">
        <v-card style="width: 500px">
            <v-card-title>Settings</v-card-title>
            <v-card-text>
                <v-text-field :disabled="saveLoading" label="GraphQL Endpoint" v-model="settings.graphql_endpoint" />
                <v-text-field :disabled="saveLoading" label="ClientId" v-model="settings.client_id" />
                <v-text-field :disabled="saveLoading" label="ClientSecret Endpoint" v-model="settings.client_secret" />
                <v-text-field :disabled="saveLoading" label="NIN" v-model="settings.nin" />
                <v-btn @click="saveClick" :loading="saveLoading">save</v-btn>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    data: () => ({
        settings: {
            graphql_endpoint: '',
            client_id: '',
            client_secret: '',
            nin: ''
        },
        settingsLoaded: false,
        saveLoading: false,
    }),
    methods: {
        async saveClick(){
            this.saveLoading = true
            try {
                await this.$api.putSettings(this.settings)
                alert('Settings were successfully saved!')
            } catch (error) {
                console.error(error)
                alert('An error occured when saving settings, Please try again')
            }
            this.saveLoading = false
        },
        async loadSettings(){
            try {
                this.settings = await this.$api.getSettings()
                this.settingsLoaded = true
            } catch (error) {
                console.error(error)
                alert('An error occured when loading settings')
            }
        }
    },
    created(){
        this.loadSettings()
    }
}
</script>

<style lang="scss" scoped>
.admin-settings{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>