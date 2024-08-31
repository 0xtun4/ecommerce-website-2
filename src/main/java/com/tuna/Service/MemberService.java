package com.tuna.Service;

import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.Models.Member;
import com.tuna.Repositories.Response.LoginResponse;

import java.util.Optional;

public interface MemberService {
    String addMember(MemberDTO memberDTO);
    String updateMember(MemberDTO memberDTO, Long id);
    String deleteMember(Long memberId);
    LoginResponse loginMember(LogInDTO loginDTO);
    Optional<Member> findMemberById(Long id);


    String changePassword(MemberDTO memberDTO, Long id);
}
