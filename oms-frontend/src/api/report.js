import request from '@/services/request';

export const getReport = () => {
    return request({
        url: 'all/report',
        method: 'get'
    })
}   