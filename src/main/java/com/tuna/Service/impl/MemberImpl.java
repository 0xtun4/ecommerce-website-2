package com.tuna.Service.impl;



import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.Entity.Member;
import com.tuna.Service.MemberService;
import com.tuna.repositories.MemberRepo;
import com.tuna.repositories.response.LoginResponse;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class MemberImpl implements MemberService {
    @Autowired
    private MemberRepo memberRepo;
    @Autowired
    private PasswordEncoder passwordEncoder;

    @Override
    public String addMember(MemberDTO memberDTO) {
        Member member = new Member(
                memberDTO.getMember_id(),
                memberDTO.getMember_name(),
                memberDTO.getEmail(),
                this.passwordEncoder.encode(memberDTO.getPassword())
        );
        this.memberRepo.save(member);
        return member.getMember_name();
    }

    @Override
    public LoginResponse loginMember(LogInDTO loginDTO) {
        String msg = "";
        Member member1 = memberRepo.findByEmail(loginDTO.getEmail());
        if (member1 != null) {
            String password = loginDTO.getPassword();
            String encodedPassword = member1.getPassword();
            boolean isPwdRight = passwordEncoder.matches(password, encodedPassword);
            if (isPwdRight) {
                Optional<Member> member = memberRepo.findOneByEmailAndPassword(loginDTO.getEmail(), encodedPassword);
                if (member.isPresent()) {
                    msg = "Login Success";
                    return new LoginResponse(msg, true);
                } else {
                    msg = "Login Failed";
                    return new LoginResponse(msg, false);
                }
            } else {
                msg = "Password Not Match";
                return new LoginResponse(msg, false);
            }
        } else {
            msg = "Email not exists";
            return new LoginResponse(msg, false);
        }
    }
}
