package com.tuna.Controller;

import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.repositories.response.LoginResponse;
import com.tuna.Service.MemberService;
import com.tuna.payload.response.LoginMessage;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin
@RequestMapping("/api/public")
public class MemberController {
    @Autowired
    private  MemberService memberService;


    @PostMapping(path = "/add")
    public String addMember(@RequestBody MemberDTO memberDTO) {
        String id = memberService.addMember(memberDTO);
        return id;
    }
    @PostMapping(path = "/login")
    public ResponseEntity<?> loginMember(@RequestBody LogInDTO loginDTO) {
        LoginResponse  loginResponse = memberService.loginMember(loginDTO);
        return ResponseEntity.ok(loginResponse);
    }

    

}
