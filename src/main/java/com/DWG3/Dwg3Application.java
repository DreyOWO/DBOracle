package com.DWG3;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Import;

@SpringBootApplication
@ComponentScan("com.DWG3")
@Import(AppConfig.class)
public class Dwg3Application {

	public static void main(String[] args) {
		SpringApplication.run(Dwg3Application.class, args);
	}

}
