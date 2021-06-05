<template>
    <div class="common-content">
        <iframe
            width="560"
            height="315"
            src="https://www.youtube-nocookie.com/embed/UUPG9KgzUuU"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>

        <br> <br> <br>

        <v-footer padless>
            <v-card class="flex" tile>
                <v-card-text class="py-2 white--text text-center">
                    <div class="share-btn-wrapper">
                        <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdev.capiq.se%2F&layout=button_count&size=small&appId=427749817832678&width=91&height=20" width="91" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    </div>
                    <a class="footer-links" href="mailto:invest@capiq.se">Email us</a>
                    <a class="footer-links" :href="readmoreLink" target="_blank">Readmore about us</a>
                    <a class="footer-links" href="https://capiq.se" target="_blank">Capiq.se</a>
                </v-card-text>
            </v-card>
        </v-footer>
    </div>
</template>

<script>
export default {
    computed: {
        readmoreLink(){
            return this.$api.API_BASE_URL + '/readmore.php'
        }
    }
}
</script>

<style lang="scss">
$primary: #34495E;
$colorVar1: #35495e;
$colorVar2: #467977;
.common-content{
    width: 100%;
    text-align: center;
    .footer-links{
        color: $primary;
        font-weight: bold;
        margin: 0 0.5rem;
        &:hover {
            color: $colorVar2;
        }
    }
    .share-btn-wrapper{
        display: inline-block;
        position: relative;
        top: 5px;
    }
    .v-card{
        width: 100% !important;
    }
}
</style>