package com.tuna.Service.impl;



import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.Entity.Member;
import com.tuna.Service.MemberService;
import com.tuna.repositories.MemberRepo;
import com.tuna.repositories.response.LoginResponse;
import com.tuna.repositories.response.ResponseObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.PathVariable;

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
                this.passwordEncoder.encode(memberDTO.getPassword()),
                null,
                null,
                true
        );
        this.memberRepo.save(member);
        return member.getMember_name();
    }

//    @Override
    public String updateMember(MemberDTO memberDTO) {
        return null;
//        try {
//            Optional<Member> optionalMember = this.memberRepo.findById(memberDTO.getMember_id());
//
//            if (optionalMember.isPresent()) {
//                Member existingMember = optionalMember.get();
//                existingMember.setMember_name(memberDTO.getMember_name());
//                existingMember.setEmail(memberDTO.getEmail());
//                existingMember.setPhone(memberDTO.getPhone());
//                existingMember.setAddress(memberDTO.getAddress());
//                existingMember.setStatus(memberDTO.isStatus());
//                this.memberRepo.save(existingMember);
//                return ResponseEntity.ok("Cập nhật thành viên thành công!");
//            } else {
//                return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Thành viên không tồn tại.");
//            }
//        } catch (Exception e) {
//            e.printStackTrace();
//            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("Lỗi khi cập nhật thành viên: " + e.getMessage());
//        }
    }



    @Override
    public String deleteMember(long memberId) {
        try {
            this.memberRepo.deleteById(memberId);
            return "Xóa thành viên thành công!";
        } catch (Exception e) {
            // Xử lý ngoại lệ khi xóa thành viên
            e.printStackTrace();
            return "Lỗi khi xóa thành viên: " + e.getMessage();
        }
    }

    @Override
    public LoginResponse loginMember(LogInDTO loginDTO) {
        String msg;
        Member member1 = memberRepo.findByEmail(loginDTO.getEmail());
        if (member1 != null) {
            String password = loginDTO.getPassword();
            String encodedPassword = member1.getPassword();
            boolean isPwdRight = passwordEncoder.matches(password, encodedPassword);
            if (isPwdRight) {
                msg = "Login Success";
                return new LoginResponse(msg, true);
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
