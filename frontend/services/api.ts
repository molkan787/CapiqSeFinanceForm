const dev = process.env.NODE_ENV !== 'production';
const API_BASE_URL = dev ? 'http://localhost/api' : 'https://dev.capiq.se/api';

export class Api{

    constructor(private axios: any){}

    public async getInvestmentProposal() {
        const { data } = await this.axios.get(`${API_BASE_URL}/investmentProposal.php`)
        return data
    }

    public async submitForm(data: any){
        return await this.axios.post(`${API_BASE_URL}/submitForm.php`, data)
    }

    public async getSettings(){
        const { data } = await this.axios.get(`${API_BASE_URL}/admin_settings.php`)
        return data
    }

    public async putSettings(settings: any){
        return await this.axios.post(`${API_BASE_URL}/admin_settings.php`, settings)
    }

}