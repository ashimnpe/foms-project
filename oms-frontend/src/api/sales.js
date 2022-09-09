import request from '@/services/request';

export const getSales = () => {
    return request({
        url: 'all/sales',
        method: 'get'
    })
}   