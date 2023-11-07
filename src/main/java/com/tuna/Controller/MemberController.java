package com.tuna.Controller;

import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.Models.Member;
import com.tuna.Repositories.Response.LoginResponse;
import com.tuna.Service.MemberService;
import com.tuna.Repositories.Response.ResponseObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@CrossOrigin
@RequestMapping("/api/public")
public class MemberController {
    @Autowired
    private  MemberService memberService;

    @PostMapping(path = "/register")
    public String addMember(@RequestBody MemberDTO memberDTO) {
        String id = memberService.addMember(memberDTO);
        return id;
    }

    @GetMapping(path = "/{id}")
    public ResponseEntity<ResponseObject> seeMember(@PathVariable Long id) {
        Optional<Member> member = memberService.findMemberById(id);
        return member.map(member1 -> ResponseEntity.ok(new ResponseObject("Success", "Member found", member1)))
                .orElseGet(() -> ResponseEntity.ok(new ResponseObject("Error", "Member not found", "")));
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
        LoginResponse loginResponse = memberService.loginMember(loginDTO);
        return ResponseEntity.ok(loginResponse);
    }

    @PostMapping(path = "/changePassword/{id}")
    public ResponseEntity<?> changePassword(@RequestBody MemberDTO memberDTO, @PathVariable Long id) {
        String member = memberService.changePassword(memberDTO, id);
        return ResponseEntity.ok(member);
    }

}
