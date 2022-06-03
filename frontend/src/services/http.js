import axios from "axios";

const axiosInstance = axios.create({
  headers:{
    "Content-type":"application/json"
  },
  baseURL:"http://localhost:8000"
});

export default axiosInstance;