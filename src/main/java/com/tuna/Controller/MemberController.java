package com.tuna.Controller;

import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.Entity.Member;
import com.tuna.repositories.response.LoginResponse;
import com.tuna.Service.MemberService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

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
    @PutMapping(path = "/update/{id}")
    public ResponseEntity<?> updateMember(@RequestBody MemberDTO memberDTO, @PathVariable Long id) {
        String member = memberService.updateMember(memberDTO, id);
        return ResponseEntity.ok(member);
    }
    @DeleteMapping(path = "/delete/{id}")
    public ResponseEntity<?> deleteMember(@PathVariable Long id) {
        String member = memberService.deleteMember(id);
        return ResponseEntity.ok(member);
    }

    @PostMapping(path = "/login")
    public ResponseEntity<?> loginMember(@RequestBody LogInDTO loginDTO) {
        LoginResponse  loginResponse = memberService.loginMember(loginDTO);
        return ResponseEntity.ok(loginResponse);
    }

//    @GetMapping(path = "/{id}")
//    public ResponseEntity<?> seeMember(@PathVariable Long id, MemberDTO memberDTO) {
//        memberDTO = memberService.seeMember(id);
//        return ResponseEntity.ok(memberDTO);
//    }


}
