/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.DWG3.domain;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Data;

@Data
@Entity
@Table(name="detalles")
public class Detalles {
    private static final long serialVersionUID = 1L;
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long idDetalle;
    
    private String nombre;
    private int idMoneda;
    private int porcentajeImp;
    private String cabys;
    private float precio;
    private float precioFinal;
    private int tipo_detalle;
    //private String result;
    
    public Detalles() {
    }
    
    public Detalles(int idMoneda){
        this.idMoneda = idMoneda;
    }

    public Detalles(String nombre, int idMoneda, int porcentajeImp, String cabys, float precio, float precioFinal, int tipo_detalle) {
        this.nombre = nombre;
        this.idMoneda = idMoneda;
        this.porcentajeImp = porcentajeImp;
        this.cabys = cabys;
        this.precio = precio;
        this.precioFinal = precioFinal;
        this.tipo_detalle = tipo_detalle;
    }
    
    
    
    
    
}



