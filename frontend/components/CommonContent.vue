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

        <!-- <v-footer padless>
            <v-card class="flex" tile>
                <v-card-text class="py-2 white--text text-center">
                    
                </v-card-text>
            </v-card>
        </v-footer> -->
        <div class="footer">
            <div class="cols-wrapper">
                <div class="col">
                    <label class="title">Om CapIQ</label>
                    <ul>
                        <li> <a class="footer-links" href="https://capiq.se" target="_blank">Vår hemsida</a> </li>
                        <li> <a class="footer-links" :href="readmoreLink" target="_blank">Memorandum</a> </li>
                    </ul>
                </div>
                <div class="col">
                    <label class="title">Har du frågor</label>
                    <ul>
                        <li> <a class="footer-links" href="mailto:invest@capiq.se">Skicka mail</a> </li>
                    </ul>
                </div>
                <div class="col">
                    <label class="title">Dela på facebook</label>
                    <ul>
                        <li>
                            <div class="share-btn-wrapper">
                                <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdev.capiq.se%2F&layout=button_count&size=small&appId=427749817832678&width=91&height=20" width="91" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            </div>
                        </li>
                    </ul>
                </div>    
            </div>            
        </div>
        <div class="copyright">
            © Copyright 2021 CapIQ. Alla rättigheter förbehållna.
        </div>
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
    .share-btn-wrapper{
        display: inline-block;
        position: relative;
        top: 5px;
    }
    .v-card{
        width: 100% !important;
    }
    .footer{
        background: #111;
        padding: 40px 0;
        color: #fff;
        text-align: left;
        .cols-wrapper{
            max-width: 1000px;
            margin: auto;
            display: flex;
            flex-direction: row;
        }
        .col{
            flex-grow: 1;
            ul{
                list-style: none;
                li{
                    margin-bottom: 12px;
                    color: #fff;
                    line-height: 1.3;
                    a{
                        position: relative;
                        color: inherit;
                        text-decoration: none;
                        transition: all 0.3s ease-in-out 0s;
                        &:hover{
                            color: #89c53f;
                        }
                    }
                }
            }
            .title{
                position: relative;
                margin: 0 0 15px 0;
                padding: 0;
                font-weight: 600;
                line-height: 1.2;
                padding-bottom: 12px;
                margin-bottom: 20px;
                color: #89c53f;
                font-size: 24px;
                &:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    height: 2px;
                    width: 50px;
                    background: #89c53f;
                }
            }
        }
    }
    .copyright{
        padding: 25px 0;
        text-align: center;
        background: #000;
        color: #fff;
    }
}
</style>