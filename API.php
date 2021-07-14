<?php


package main

import (
  "net/http"
  "log"
  "io/ioutil"
)

func main() {
  MakeRequest()
}

func MakeRequest() {
  resp, err := http.Get("https://emailvalidation.abstractapi.com/v1/?api_key=cf1c91faa660429187be994b5ecc2c82&email=khokonchandra4@gmail.com")
  if err != nil {
    log.Fatalln(err)
  }

  body, err := ioutil.ReadAll(resp.Body)
  if err != nil {
    log.Fatalln(err)
  }

  log.Println(string(body))
}