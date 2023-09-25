import axios from 'axios'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

export function registerUser(user) {
  return axios.post('/api/auth/register', user)
}

export function loginUser(user) {
  return axios.post('/api/auth/login', user)
}

export function logoutUser() {
  return axios.get('/api/auth/logout')
}

export function getUser() {
  return axios.get('/api/auth/user')
}

export function getEvents() {
  return axios.get('/api/events/events')
}

export function getUsers(id) {
  return axios.get('/api/events/users', {params: {id: id}})
}

export function addEvent(event) {
  return axios.post('/api/events/create', event)
}

export function deleteEvent(id) {
  return axios.post('/api/events/remove', {id})
}

export function checkEvent(id) {
  return axios.post('/api/events/toggle', {id})
}

