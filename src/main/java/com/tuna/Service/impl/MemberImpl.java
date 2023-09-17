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
        this.memberRepo.save(member);
        return member.getMember_name();
    }

    @Override
    public String updateMember(MemberDTO memberDTO, Long id) {
        Member member = this.memberRepo.findById(id).orElse(null);
        if (member != null) {
            member.setMember_name(memberDTO.getMember_name());
            member.setEmail(memberDTO.getEmail());
//            member.setPassword(this.passwordEncoder.encode(memberDTO.getPassword()));
            member.setPhone(memberDTO.getPhone());
            member.setAddress(memberDTO.getAddress());
            member.setStatus(memberDTO.getStatus());
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

//    @Override
//    public String seeMember(Long id, MemberDTO memberDTO) {
//        Member member = this.memberRepo.findById(id).orElse(null);
//        if (member != null) {
//            member.getMember_name();
//            member.getEmail();
//            member.getPassword();
//            member.getPhone();
//            member.getAddress();
//            member.getStatus();
//            return "Lấy thành công thành viên: " + member.getMember_name();
//        }
//        return "Lỗi khi lấy thành viên: " ;
//    }

//    @Override
//    public MemberDTO findMemberByName(String memberName) {
//        Member member = memberRepo.findByMemberName(memberName); // Tìm thành viên theo tên
//
//        if (member != null) {
//            // Tạo một đối tượng MemberDTO để trả về thông tin thành viên
//            MemberDTO memberDTO = new MemberDTO();
//            memberDTO.setMember_id(member.getMember_id());
//            memberDTO.setMember_name(member.getMember_name());
//            memberDTO.setEmail(member.getEmail());
//            memberDTO.setPhone(member.getPhone());
//            memberDTO.setAddress(member.getAddress());
//            memberDTO.setStatus(member.getStatus());
//
//            return memberDTO;
//        }
//
//        return null; // Trả về null nếu không tìm thấy thành viên
//    }


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
