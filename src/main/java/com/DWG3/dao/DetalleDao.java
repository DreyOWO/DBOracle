/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package com.DWG3.dao;

import com.DWG3.domain.Detalles;
import java.util.List;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.query.Procedure;
import org.springframework.data.repository.query.Param;

//REPOSITORIO
public interface DetalleDao extends JpaRepository<Detalles, Long> {
    @Procedure(name="usp_lista_detalles_factura")
    List<Detalles> usp_lista_detalles_factura(@Param("id_moneda_p") int idMoneda);
}
