/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.DWG3;

import com.DWG3.service.ClienteServiceImpl;
import com.DWG3.service.DetalleService;
import com.DWG3.service.DetalleServiceImpl;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.Primary;

@Configuration
public class AppConfig {
    
    @Bean
    @Primary
    public DetalleServiceImpl detalleService() {
        return new DetalleServiceImpl();
    }
    
    @Bean
    @Primary
    public ClienteServiceImpl clienteService() {
        return new ClienteServiceImpl();
    }
}
