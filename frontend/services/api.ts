const dev = process.env.NODE_ENV !== 'production';
const API_BASE_URL = dev ? 'http://localhost/api' : 'https://invest.capiq.se/api';

export class Api{

    public API_BASE_URL: string = API_BASE_URL;

    constructor(private axios: any){}

    public async getInvestmentProposal() {
        const { data } = await this.axios.get(`${API_BASE_URL}/investmentProposal.php`)
        return data
    }

    public async submitForm(formData: any){
        const { data } = await this.axios.post(`${API_BASE_URL}/submitForm.php`, formData)
        return data
    }

    public async getSettings(){
        const { data } = await this.axios.get(`${API_BASE_URL}/admin_settings.php`)
        return data
    }

    public async putSettings(settings: any){
        return await this.axios.post(`${API_BASE_URL}/admin_settings.php`, settings)
    }

    public async requestAuthorizationCode(internalRedirect: string){
        const { data } = await this.axios.post(`${API_BASE_URL}/requestAuthorizationCode.php`, {
            internalRedirect
        })
        return data
    }

    public async getThankyouMessage(info: any){
        const { data } = await this.axios.post(`${API_BASE_URL}/thankyou_message.php`, info)
        return data
    }

}