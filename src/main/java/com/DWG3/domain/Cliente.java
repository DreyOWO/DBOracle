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
@Table(name="clientes")
public class Cliente {
    private static final long serialVersionUID = 1L;
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long idCliente;
    
    private String nombre;
    private int idTipoIdent;
    private String identificacion;
    private String telefono;
    private String correo;
    private boolean facturaElectronicamente;
    private boolean tieneCredito;
    private int diasCredito;
    private float limiteCredito;
    //public String result;
    private String situacionHacienda;

    public Cliente() {
    }

    public Cliente(String nombre, int idTipoIdent, String identificacion, String telefono, String correo, boolean facturaElectronicamente, boolean tieneCredito, int diasCredito, float limiteCredito, String situacionHacienda) {
        this.nombre = nombre;
        this.idTipoIdent = idTipoIdent;
        this.identificacion = identificacion;
        this.telefono = telefono;
        this.correo = correo;
        this.facturaElectronicamente = facturaElectronicamente;
        this.tieneCredito = tieneCredito;
        this.diasCredito = diasCredito;
        this.limiteCredito = limiteCredito;
        this.situacionHacienda = situacionHacienda;
    }

   
    
    
    
    
    
    
    
    
}
