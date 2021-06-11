<template>
    <div>
        <div class="header">
            <h1 class="grand-title">
               Vi på CapIQ tackar för visat intresse och ert förtroende
            </h1>
        </div>
        <div class="container">
            <div class="mycard">
                <div v-html="messageHTML"></div>
            </div>
            <br>
            <br>
        </div>
    </div>
</template>

<script>
import qs from 'querystring'

export default {
    data: () => ({
        messageHTML: ''
    }),
    async created(){
        if(process.client){
            const params = qs.parse(window.location.href.split('?')[1] || '')
            const info = JSON.parse(atob(decodeURIComponent(params.info)))
            const msg = await this.$api.getThankyouMessage(info);
            this.messageHTML = msg;
        }
    }
}
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
    min-height: 60vh;
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
.v-card__title{
    color: #232f3b !important;
}
.v-card__text{
    color: rgba(#232f3b, 0.9) !important;
    font-size: 1rem;
}
</style>
