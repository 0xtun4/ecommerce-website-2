package com.tuna.Service.Ipml;



import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.Models.Member;
import com.tuna.Service.MemberService;
import com.tuna.Repositories.MemberRepo;
import com.tuna.Repositories.Response.LoginResponse;
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
                (int) memberDTO.getMember_id(),
                memberDTO.getMember_name(),
                memberDTO.getEmail(),
                this.passwordEncoder.encode(memberDTO.getPassword()),
                null,
                null,
                null
        );
        if (this.memberRepo.findByEmail(memberDTO.getEmail()) != null) {
            return "Email đã tồn tại!";
        }
        else {
            this.memberRepo.save(member);
            return "Thêm thành công thành viên: " + member.getMember_name();
        }
    }

    @Override
    public String updateMember(MemberDTO memberDTO, Long id) {
        Member member = this.memberRepo.findById(id).orElse(null);
        if (member != null) {
            member.setMember_name(memberDTO.getMember_name());
            member.setEmail(memberDTO.getEmail());
            member.setPhone(memberDTO.getPhone());
            member.setAddress(memberDTO.getAddress());
            member.setStatus(memberDTO.getStatus());
            this.memberRepo.save(member);
            return "Cập nhật thành công!";
        }
        return "Không tìm thấy thành viên!";
    }

    @Override
    public String changePassword(MemberDTO memberDTO, Long id) {
       Member member = this.memberRepo.findById(id).orElse(null);
        if (member != null) {
            member.setPassword(this.passwordEncoder.encode(memberDTO.getPassword()));
            this.memberRepo.save(member);
            return "Cập nhật thành công!";
        }
        return "Không tìm thấy thành viên!";
    }

    @Override
    public String deleteMember(Long memberId) {
        Member member = this.memberRepo.findById(memberId).orElse(null);
        if (member != null) {
            this.memberRepo.delete(member);
            return "Xóa thành công thành viên: " + member.getMember_name();
        }
            return "Lỗi khi xóa thành viên: " ;
//        }
    }

    public LoginResponse loginMember(LogInDTO loginDTO) {
        String msg;
        Member member = memberRepo.findByEmail(loginDTO.getEmail());
        if (member == null) {
            msg = "Email not exists";
            return new LoginResponse(msg, false, null, null);
        }
        String password = loginDTO.getPassword();
        String encodedPassword = member.getPassword();
        boolean isPwdRight = passwordEncoder.matches(password, encodedPassword);
        if (!isPwdRight) {
            msg = "Password Not Match";
            return new LoginResponse(msg, false, null, null);
        }

        msg = "Login Success";
        return new LoginResponse(msg, true, member.getMember_id(), member.getEmail());
    }

    @Override
    public Optional<Member> findMemberById(Long id) {
        return this.memberRepo.findById(id);
    }




}
