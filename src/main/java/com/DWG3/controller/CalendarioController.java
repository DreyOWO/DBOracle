/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/springframework/Controller.java to edit this template
 */
package com.DWG3.controller;

import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

/**
 *
 * @author musst
 */
@Controller
public class CalendarioController {

    @GetMapping("/calendario")
    public String calendario() {
        return "calendario";
    }
    
    @RequestMapping("/calendario")
    public String page(Model model) {
        model.addAttribute("attribute", "value");
        return "Calendario";
    } 
    
}
